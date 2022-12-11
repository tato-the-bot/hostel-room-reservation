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
    </head>

    <body>
        @include('header')
        
        <div class="room" style="margin-top:150px">
            <h1 style="font-size: 30px;color: black;font-weight: bold;text-align: center;">Rooms</h1>
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

            <form method="post" action="{{ route('agent.room-create') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <table>
                    <tr>
                        <td>
                            Room Title:
                        </td>
                        <td>
                            <input name="room_title" class="form-control" type="text" value="{{$room_title}}" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Room Type:
                        </td>
                        <td>
                        <select name="room_type" id="room_type" class="form-select" value="{{$room_type}}" required>
                            <option value="">Select Room Type</option>
                            @foreach(\App\Models\Room::ROOM_TYPE_LABEL as $value => $label)
                                <option value="{{$value}}">{{$label}}</option>
                            @endforeach
                        </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Room Description:
                        </td>
                        <td>
                            <textarea name="room_desc" rows="4" cols="50" class="form-control">{{$room_desc}}</textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Location:
                        </td>
                        <td>
                            <select name="location" id="location" class="form-select" value="{{$location}}" required>
                                <option value="">Select Location</option>
                                @foreach(\App\Models\Room::LOCATION_OPTIONS as $location)
                                    <option value="{{$location}}">{{$location}}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Monthly Rental:
                        </td>
                        <td>
                            <input name="monthly_rental" type="number" class="form-control" required value="{{$monthly_rental}}">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Deposit:
                        </td>
                        <td>
                        <input name="deposit" type="number" class="form-control" value="{{$deposit}}" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Image:
                        </td>
                        <td>
                            <input name="image" type="file" class="form-control" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Remark:
                        </td>
                        <td>
                            <input name="remark" type="text" class="form-control" value="{{$remark}}">
                        </td>
                    </tr>
                </table>
                <button class="btn btn-primary" type="submit">Create</button>
            </form>
        </div>
    </body>
    
    @include('footer')
</html>
