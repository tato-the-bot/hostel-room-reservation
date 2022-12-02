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

    </head>

    <body>
        
        @include('header')
        
        <div class="room" style="margin-top:150px">
            <h1 style="font-size: 30px;color: black;font-weight: bold;text-align: center;">Reservations</h1>
            <hr style="width:90%;border-top: 2px groove #8c8c8c;">
        </div>

        <div class="container pb-4">
            <table class="table">
                <thead>
                    <tr>
                        <th>
                            Transaction ID
                        </th>
                        <th>
                            Room ID                        
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
                            {{ $reservation->transaction_id }}
                        </td>
                        <td>
                            {{ $reservation->room_id }}
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
                                <a href="{{ route('reservation-update', $reservation->id) }}" class="btn btn-primary">Update Reservation</a>
                                @if ($reservation->status == \App\Models\Reservation::STATUS_TYPE_APPROVED)
                                <a href="{{ route('reservation-pay', $reservation->id) }}" class="btn btn-secondary">Make Payment</a>
                                @else
                                <a href="{{ route('reservation-pay', $reservation->id) }}" class="btn btn-secondary disabled">Make Payment</a>
                                @endif
                                <a id="cancel" href="{{ route('reservation-cancel', $reservation->id) }}" class="btn btn-warning">Cancel</a>
                                @endif
                            @endif
                        </td>
                    </tr>
                    <script>
                        $('#cancel').click(function(e) {
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
<script src="https://www.paypal.com/sdk/js?client-id=CLIENT_ID"></script>
<script>
    function warning(){
        if(confirm("Are you sure you want to cancel the reservation?")){
            
        }else{

        }
    }
</script>
