<html>
    <h3>Room Update - Form</h3>

</html>

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
            <h1 style="font-size: 30px;color: black;font-weight: bold;text-align: center;margin-top: -35px">Rooms</h1>
            <hr style="width:90%;border-top: 2px groove #8c8c8c;margin-left: 75px;">
        </div>

        <div class="container pb-4">

        @if(count($errors) > 0) 
        <div class="alert alert-danger">
            @foreach ($errors as $error) 
                <div>{{$error[0]}}</div>
            @endforeach
        </div>
        @endif

        <form method="post" action="{{ route('agent.room-update' , $room->id) }}" enctype="multipart/form-data">
        {{ csrf_field() }}

        <table>
            <tr>
                <td>
                    Room Title:
                </td>
                <td>
                    <input name="room_title" class="form-control" type="text" value="{{ $room_title }}" required>
                </td>
            </tr>
            <tr>
                <td>
                    Room Type:
                </td>
                <td>
                <select name="room_type" id="room_type" value="{{ $room_type }}" class="form-select" required>
                    <option value="">Select Room Type</option>
                    @foreach(\App\Models\Room::ROOM_TYPE_LABEL as $value => $label)
                        <option value="{{$value}}" {{ $value == $room_type ? 'selected' : '' }}>{{$label}}</option>
                    @endforeach
                </select>
                </td>
            </tr>
            <tr>
                <td>
                    Room Description:
                </td>
                <td>
                    <textarea name="room_desc" rows="4" cols="50" class="form-control">{{ $room_desc }}</textarea>
                </td>
            </tr>
            <tr>
                <td>
                    Location:
                </td>
                <td>
                    <select name="location" id="location" class="form-select" value="{{$location}}" required>
                        <option value="">Select Location</option>
                        @foreach(\App\Models\Room::LOCATION_OPTIONS as $loc)
                            <option value="{{$loc}}" {{ $loc == $location ? 'selected' : '' }}>{{$loc}}</option>
                        @endforeach
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    Monthly Rental:
                </td>
                <td>
                    <input name="monthly_rental" type="number" value="{{ $monthly_rental }}" class="form-control" required>
                </td>
            </tr>
            <tr>
                <td>
                    Deposit:
                </td>
                <td>
                <input name="deposit" type="number" value="{{ $deposit }}" class="form-control" required>
                </td>
            </tr>
            <tr>
                <td>
                    Image:
                </td>
                <td>
                    <img src='{{ $room->image }}' style="width:440px; height:240px;">
                    <input name="image" type="file" class="form-control">
                </td>
            </tr>
            <tr>
                <td>
                    Remark:
                </td>
                <td>
                    <input name="remark" type="text" value="{{ $remark }}" class="form-control">
                </td>
            </tr>
        </table>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
        </div>
    </body>
    
    @include('footer')
</html>
