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
            <h1 style="font-size: 30px;color: black;font-weight: bold;text-align: center;">Agent Profile</h1>
            <hr style="width:90%;border-top: 2px groove #8c8c8c;">
        </div>

        <div class="container pb-4">
            <div class="row">
                <div class="col-4">
                    @if($agent->image != NULL)
                    <img src="{{ $agent->image }}" height="250" width="250" class="card-img-top" >
                    @endif
                </div>

                <div class="col-8">
                    <div class="container-fluid">
                        <div class="row pt-4">
                            <div class="col-3">
                                Name : 
                            </div>
                            <div class="col-9">
                                {{ $agent->name }}
                            </div>
                        </div>

                        <div class="row pt-4">
                            <div class="col-3">
                                Email : 
                            </div>
                            <div class="col-9">
                                {{ $agent->email }}
                            </div>
                        </div>

                        <div class="row pt-4">
                            <div class="col-3">
                                Phone No : 
                            </div>
                            <div class="col-9">
                                {{ $agent->phone_number }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    
    @include('footer')
</html>
