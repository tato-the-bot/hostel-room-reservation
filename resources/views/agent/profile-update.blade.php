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
        <form class="container pb-4" method="POST" action="{{ route('agent.profile-update') }}" enctype="multipart/form-data">
            @if(count($errors) > 0) 
                <div class="alert alert-danger">
                    @foreach ($errors as $error) 
                        <div>{{$error[0]}}</div>
                    @endforeach
                </div>
            @endif

            @csrf
            <div class="container pb-4">
                <div class="row">
                    <div class="col-4">
                        <img src="{{ $agent->image }}" height="250" width="250" class="card-img-top" >
                        <input name="image" type="file" class="form-control mt-1">
                    </div>

                    <div class="col-8">
                        <div class="container-fluid">
                            <div class="row pt-4">
                                <div class="col-3">
                                    Name :
                                </div>
                                <div class="col-9">
                                    <input name="name" class="form-control" type="text" value="{{ $agent->name }}">
                                </div>
                            </div>

                            <div class="row pt-4">
                                <div class="col-3">
                                    Email :
                                </div>
                                <div class="col-9">
                                    <input name="email" class="form-control" type="text" value="{{ $agent->email }}">
                                </div>
                            </div>

                            <div class="row pt-4">
                                <div class="col-3">
                                    Phone No :
                                </div>
                                <div class="col-9">
                                    <input name="phone_number" class="form-control" type="text" value="{{ $agent->phone_number }}">
                                </div>
                            </div>
                            <div class="row pt-5">
                                <div class="col-12">
                                    <button type="submit" class="btn-primary btn text-uppercase w-100">Confirm Update Profile</button>
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </body>
    
    @include('footer')
</html>
