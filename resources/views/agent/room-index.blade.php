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
            <h1 style="font-size: 30px;color: black;font-weight: bold;text-align: center;">Rooms</h1>
            <hr style="width:90%;border-top: 2px groove #8c8c8c;">
        </div>

        

        <div class="container pb-4">
            <div class="row py-4">
                <div class="col-12">
                    <a class="btn btn-primary" href="{{ route('agent.room-create') }}">
                        Create New Room
                    </a>
                </div>
            </div>

            <table class="table">
                <thead>
                    <tr>
                        <th>
                            Title
                        </th>
                        <th>
                            Room Type
                        </th>
                        <th>
                            Monthly Rental (RM)
                        </th>
                        <th>
                            Deposit (RM)
                        </th>
                        <th>
                            Image
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
                    @foreach ($rooms as $room)
                    <tr>
                        <td>
                            {{ $room->room_title }}
                        </td>
                        <td>
                            {{ \App\Models\Room::ROOM_TYPE_LABEL[$room->room_type] }}
                        </td>
                        <td>
                            {{ $room->monthly_rental }}
                        </td>
                        <td>
                            {{ $room->deposit }}
                        </td>
                        <td>
                            <img src="{{ $room->image }}" height="150" width="250">
                        </td>
                        <td>
                            {{ \App\Models\Room::STATUS_LABEL[$room->status] }}
                        </td>
                        <td>
                            <a href="{{ route('agent.room-update', $room->id) }}">Edit</a>
                            <a href="{{ route('agent.room-delete', $room->id) }}" id="delete">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                     <script>
                        $('#delete').click(function(e) {
                            e.preventDefault();
                            if (confirm('Are you sure you want to delete the room?')) {
                                location.href = "{{ route('agent.room-delete', $room->id) }}";
                            } else {
                                return false;
                            }
                        });
                    </script>
                </tbody>
            </table>
        </div>
    </body>
    
    @include('footer')
</html>
