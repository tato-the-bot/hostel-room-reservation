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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"/>
    </head>

    <body>

        @include('header')

        <div class="room" style="margin-top:150px">
            <h1 style="font-size: 30px;color: black;font-weight: bold;text-align: center;">Room & Category</h1>
            <hr style="width:90%;border-top: 2px groove #8c8c8c;margin-left: 75px;">
        </div>

        <div class="container pb-4">
            <form method="GET">
                <div class="row">
                    <div class="col-3 mt-4">
                        <input name="search" class="form-control" type="text" value="{{ $search }}">
                    </div>

                    <div class="col-3 mt-4">
                        <select name="room_type" class="form-select" value="{{$room_type}}">
                            <option value="">Select Room Type</option>
                            @foreach(\App\Models\Room::ROOM_TYPE_LABEL as $value => $label)
                            <option value="{{$value}}" {{ $value == $room_type ? 'selected' : '' }}>{{$label}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-3 mt-4">
                        <select name="location" class="form-select" value="{{$location}}">
                            <option value="">Select Location</option>
                            @foreach(\App\Models\Room::LOCATION_OPTIONS as $loc)
                            <option value="{{$loc}}" {{ $loc == $location ? 'selected' : '' }}>{{$loc}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-3 mt-4">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </div>
            </form>
            <div class="row">
                @foreach ($rooms as $room)
                <div class="col-3 mt-4">
                    <div class="card">
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
