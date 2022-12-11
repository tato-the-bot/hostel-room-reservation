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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"/>
    </head>

    <body>
        
        @include('header')
        
        <div class="room" style="margin-top:150px">
            <h1 style="font-size: 30px;color: black;font-weight: bold;text-align: center;">Reservations</h1>
            <div style="display:flex; justify-content:flex-end; width:100%; padding-right:100px;">
                <a href="{{ route('agent.profile-view') }}" class="btn btn-primary">Manage Profile</a>
            </div>
            <hr style="width:90%;border-top: 2px groove #8c8c8c; margin: 1rem auto !important;">
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
                            @if ($reservation->room->room_type == 'big_room')
                                Big Room
                            @elseif ($reservation->room->room_type == 'medium_room')
                                Medium Room
                            @elseif ($reservation->room->room_type == 'single_room')
                                Single Room
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
                            @if ($reservation->status == \App\Models\Reservation::STATUS_TYPE_APPROVED)
                            <span class="badge text-bg-success">{{ \App\Models\Reservation::STATUS_LABEL[$reservation->status] }}</span>
                            @else
                            <span class="badge text-bg-warning">{{ \App\Models\Reservation::STATUS_LABEL[$reservation->status] }}</span>
                            @endif
                        </td>
                        <td>
                            @if ($reservation->status == \App\Models\Reservation::STATUS_TYPE_PENDING_APPROVAL)
                            <a href="{{ route('agent.reservation-approve', $reservation->id) }}" class="btn btn-primary">Approve Reservation</a>
                            <a href="{{ route('agent.reservation-reject', $reservation->id) }}" class="btn btn-danger">Reject Reservation</a>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </body>
    
    @include('footer')
</html>
