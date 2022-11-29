<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Room</title>
    </head>

    <body>
        
        @include('header')
        
        <div class="room" style="margin-top:150px">
            <h1 style="font-size: 30px;color: black;font-weight: bold;text-align: center;">Room & Category</h1>
            <hr style="width:90%;border-top: 2px groove #8c8c8c;">
        </div>

        <div class="container pb-4">
            <div class="row">
                @foreach ($rooms as $room)
                <div class="col-3 mt-4">
                    <div class="card" style="width: 18rem;">
                        <img src="{{ $room->image }}" height="250" width="250" class="card-img-top" >
                        <div class="card-body">
                            <h5 class="card-title">{{ $room->room_title }}</h5>
                            <p class="card-text">{{ Str::limit($room->room_desc, 100, ' (...)'); }} </p>
                            <a href="{{ route('room-view', $room->id) }}" class="btn btn-primary">View Room</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </body>
    
    @include('footer')
</html>
