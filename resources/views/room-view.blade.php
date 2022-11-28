<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Room Details</title>
    </head>

    <body>
        
        @include('header')
        
        <div class="room" style="margin-top:150px">
            <h1 style="font-size: 30px;color: black;font-weight: bold;text-align: center;">Room Details</h1>
            <hr style="width:90%;border-top: 2px groove #8c8c8c;">
        </div>

        <div class="container pb-4">
            <div class="row">
                <div class="col-4">
                    <img src="{{ $room->image }}" height="250" width="250" class="card-img-top" >
                </div>

                <div class="col-8">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <h3>Details</h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                {{ $room->room_desc }}
                            </div>
                        </div>

                        <div class="row pt-4">
                            <div class="col-12">
                                <h3>Deposit</h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                RM {{ $room->deposit }}
                            </div>
                        </div>

                        <div class="row pt-4">
                            <div class="col-12">
                                <h3>Monthly Rental</h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                RM {{ $room->monthly_rental }} per month
                            </div>
                        </div>

                        <div class="row pt-4">
                            <div class="col-12">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    Booking
                                </button>
                            </div>
                        </div>

                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Reservation</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form class="container" method="POST" action="{{ route('room-book', [$room->id]) }}">
                                            @csrf
                                            <div class="row">
                                                <div class="col-6">
                                                    <strong>Room ID:</strong>
                                                </div>
                                                <div class="col-6">
                                                    <strong>Room Type:</strong>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    {{ $room->id }}
                                                </div>
                                                <div class="col-6">
                                                    {{ \App\Models\Room::ROOM_TYPE_LABEL[$room->room_type] }}
                                                </div>
                                            </div>

                                            <div class="row pt-4">
                                                <div class="col-6">
                                                    <strong>Start at:</strong>
                                                </div>
                                                <div class="col-6">
                                                    <strong>Duration (months):</strong>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <input type="date" class="form-control" name="contract_start_date">
                                                </div>
                                                <div class="col-6">
                                                    <input type="number" class="form-control" name="duration"> 
                                                </div>
                                            </div>

                                            <div class="row pt-4">
                                                <div class="col-12">
                                                    <strong>Deposit:</strong> RM {{ $room->deposit }}
                                                </div>
                                            </div>

                                            <div class="row pt-4">
                                                <div class="col-12 d-grid gap-2">
                                                    <button type="submit" class="btn btn-primary">Confirm</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    
    @include('footer')
</html>
