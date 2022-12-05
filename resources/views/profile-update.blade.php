<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Update Profile</title>
    </head>

    <body>
        
        @include('header')
        
        <div class="room" style="margin-top:150px">
            <h1 style="font-size: 30px;color: black;font-weight: bold;text-align: center;">Update Profile</h1>
            <hr style="width:90%;border-top: 2px groove #8c8c8c;">
        </div>

        <div class="container pb-4">
            <div class="row">
                <div class="col-4">
                    <img src="{{ $student->image }}" height="250" width="250" class="card-img-top" >
                </div>

                <div class="col-8">
                    <div class="container-fluid">
                        <div class="row pt-4">
                            <div class="col-4">
                                <h3>Name : </h3>
                            </div>
                            <div class="col-8">
                                <input name="room_title" class="form-control" type="text" value="{{ $room->room_desc }}">
                            </div>
                        </div>

                        <div class="row pt-4">
                            <div class="col-4">
                                <h3>Email : </h3>
                            </div>
                            <div class="col-8">
                                <input name="room_title" class="form-control" type="text" value="{{ $room->room_desc }}">
                            </div>
                        </div>

                        <div class="row pt-4">
                            <div class="col-4">
                                <h3>Phone No : </h3>
                            </div>
                            <div class="col-8">
                                <input name="room_title" class="form-control" type="text" value="{{ $room->room_desc }}">
                            </div>
                        </div>

                        <div class="row pt-4">
                            <div class="col-12">
                                <button type="button" class="btn text-uppercase">Confirm Update Profile</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    
    @include('footer')
</html>
