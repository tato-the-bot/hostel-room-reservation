<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Reservations</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="https://www.paypal.com/sdk/js?client-id=AQ17c7S81QGW3sDfkocNtUKKKX4qbMgLTtuh5jn99sB4paqE71MdofBjzukZmhwz2TJDaDsDX1BPP4Ro&currency=MYR"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"/>    
    </head>

    <body>
        
        @include('header')
        
        <div class="room" style="margin-top:150px">
            <h1 style="font-size: 30px;color: black;font-weight: bold;text-align: center;">Reservations</h1>
            <div style="display:flex; justify-content:flex-end; width:100%; padding-right:100px;">
                <p class="bg-secondary text-white px-3" style="border-radius:50px;">Welcome, {{Auth::guard('web_student')->user()->name}}</p>
            </div>
            <div style="display:flex; justify-content:flex-end; width:100%; padding-right:100px;">
                <a href="{{ route('profile-view') }}" class="btn btn-primary">Manage Profile</a>
            </div>
            <hr style="width:85%;border-top: 2px groove #8c8c8c; margin: 1rem auto !important;">
        </div>

        <div class="container pb-4">
            <table class="table">
                <thead>
                    <tr>
                        <th>
                            Room Name                        
                        </th>
                        <th>
                            Room Type                        
                        </th>
                        <th>
                            Contract Start Date
                        </th>
                        <th>
                            Contract End Date
                        </th>
                        <th>
                            Deposit
                        </th>
                        <th>
                            Monthly Rental
                        </th>
                        <th>
                            Remark
                        </th>
                        <th>
                            Status
                        </th>
                        <th>
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reservations as $reservation)
                    <tr>
                        <td>
                            @if (!empty($reservation->room))
                                {{ $reservation->room->room_title }}
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            @if (!empty($reservation->room))
                                @if ($reservation->room->room_type == 'big_room')
                                    Big Room
                                @elseif ($reservation->room->room_type == 'medium_room')
                                    Medium Room
                                @elseif ($reservation->room->room_type == 'single_room')
                                    Single Room
                                @endif
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            {{ $reservation->contract_start_date }}
                        </td>
                        <td>
                            {{ $reservation->contract_end_date }}
                        </td>
                        <td>
                            @if (!empty($reservation->room))
                                RM {{ $reservation->room->deposit }} 
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            @if (!empty($reservation->room))
                                RM {{ $reservation->room->monthly_rental }} 
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            {{ $reservation->remark }}
                        </td>
                        <td>
                            @if (empty($reservation->room))
                                <span class="badge text-bg-warning">Room Deleted</span>
                            @else
                                @if ($reservation->status == \App\Models\Reservation::STATUS_TYPE_APPROVED)
                                <span class="badge text-bg-success">{{ \App\Models\Reservation::STATUS_LABEL[$reservation->status] }}</span>
                                @else
                                <span class="badge text-bg-warning">{{ \App\Models\Reservation::STATUS_LABEL[$reservation->status] }}</span>
                                @endif
                            @endif
                        </td>
                        <td>
                            @if (empty($reservation->room))
                                
                            @else
                                @if ($reservation->status == \App\Models\Reservation::STATUS_TYPE_PENDING_APPROVAL)
                                    <a href="{{ route('reservation-update', $reservation->id) }}" class="btn btn-primary">Update</a>

                                    <a id="cancel-{{$reservation->id}}" href="{{ route('reservation-cancel', $reservation->id) }}" class="btn btn-warning">Cancel</a>
                                    
                                @elseif ($reservation->status == \App\Models\Reservation::STATUS_TYPE_APPROVED)
                                    <div id="paypal-reservation-pay-{{$reservation->id}}"></div>

                                    <form id="paypal-transaction-{{$reservation->id}}" action="{{ route('reservation-pay', $reservation->id) }}" method="POST">
                                        @csrf
                                        <input type="hidden" id="paypal-transaction-{{$reservation->id}}-transaction-no" name="transaction_no">
                                        <input type="hidden" id="paypal-transaction-{{$reservation->id}}-amount" name="amount">
                                    </form>

                                    <script>
                                    paypal.Buttons({
                                        fundingSource: paypal.FUNDING.PAYPAL,
                                        createOrder: (data, actions) => {
                                        return actions.order.create({
                                            purchase_units: [{
                                                amount: {
                                                    value: {{$reservation->room->deposit}} // Can also reference a variable or function
                                                }
                                            }]
                                        });
                                        },
                                        // Finalize the transaction after payer approval
                                        onApprove: (data, actions) => {
                                        return actions.order.capture().then(function(orderData) {
                                            const transaction = orderData.purchase_units[0].payments.captures[0];
                                            console.log(transaction);

                                            document.getElementById("paypal-transaction-{{$reservation->id}}-transaction-no").value = transaction.id;
                                            document.getElementById("paypal-transaction-{{$reservation->id}}-amount").value = transaction.amount.value;
                                            document.getElementById("paypal-transaction-{{$reservation->id}}").submit();
                                        });
                                        }
                                    }).render('#paypal-reservation-pay-{{$reservation->id}}');
                                    </script>

                                @elseif ($reservation->status == \App\Models\Reservation::STATUS_TYPE_PAID_DEPOSIT)
                                    <a target="popup" onclick="window.open('{{ route('transaction-invoice', $reservation->transaction_id) }}', 'newwindow', 'width=1000,height=500'); return false;" class="btn btn-warning">Invoice</a>
                                @endif

                            @endif
                        </td>
                    </tr>
                    <script>
                        $('#cancel-{{$reservation->id}}').click(function(e) {
                            e.preventDefault();
                            if (confirm('Are you sure you want to cancel the reservation?')) {
                                location.href = "{{ route('reservation-cancel', $reservation->id) }}";
                            } else {
                                return false;
                            }
                        });
                    </script>
                    @endforeach
                </tbody>
            </table>
        </div>
    </body>
    
    @include('footer')
</html>