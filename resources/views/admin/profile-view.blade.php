<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Profile Dashboard</title>
    </head>

    <body>
        
        @include('header')
        
        <div class="room" style="margin-top:150px">
            <h1 style="font-size: 30px;color: black;font-weight: bold;text-align: center;">Your Profile</h1>
            <hr style="width:90%;border-top: 2px groove #8c8c8c;">
        </div>

        <div class="container pb-4">
            <div class="row">
                <div class="col-4">
                    @if($admin->image != NULL)
                    <img src="{{ $admin->image }}" height="250" width="250" class="card-img-top" >
                    @endif
                </div>

                <div class="col-8">
                    <div class="container-fluid">
                        <div class="row pt-4">
                            <div class="col-3">
                                Name : 
                            </div>
                            <div class="col-9">
                                {{ $admin->name }}
                            </div>
                        </div>

                        <div class="row pt-4">
                            <div class="col-3">
                                Email : 
                            </div>
                            <div class="col-9">
                                {{ $admin->email }}
                            </div>
                        </div>

                        <div class="row pt-4">
                            <div class="col-3">
                                Phone No : 
                            </div>
                            <div class="col-9">
                                {{ $admin->phone_number }}
                            </div>
                        </div>

                        <div class="row pt-4">
                            <div class="col-6  pt-4">
                                <a class="btn text-uppercase btn-primary w-100" href="{{ route('admin.profile-update') }}">Update Profile</a>
                            </div>
                            <div class="col-6 pt-4">
                                <a class="btn btn-warning text-uppercase w-100" href="{{ route('admin.change-password') }}">Change Password</a>
                            </div>
                            <div class="col-12 pt-4">
                                <a class="btn btn-primary text-uppercase w-100" href="{{ route('logout') }}"> Logout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    
    @include('footer')
</html>
