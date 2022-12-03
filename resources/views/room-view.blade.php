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
        <style>
     .rate {
         float: left;
         height: 46px;
         padding: 0 10px;
         }
         .rate:not(:checked) > input {
         position:absolute;
         display: none;
         }
         .rate:not(:checked) > label {
         float:right;
         width:1em;
         overflow:hidden;
         white-space:nowrap;
         cursor:pointer;
         font-size:30px;
         color:#ccc;
         }
         .rated:not(:checked) > label {
         float:right;
         width:1em;
         overflow:hidden;
         white-space:nowrap;
         cursor:pointer;
         font-size:30px;
         color:#ccc;
         }
         .rate:not(:checked) > label:before {
         content: '★ ';
         }
         .rate > input:checked ~ label {
         color: #ffc700;
         }
         .rate:not(:checked) > label:hover,
         .rate:not(:checked) > label:hover ~ label {
         color: #deb217;
         }
         .rate > input:checked + label:hover,
         .rate > input:checked + label:hover ~ label,
         .rate > input:checked ~ label:hover,
         .rate > input:checked ~ label:hover ~ label,
         .rate > label:hover ~ input:checked ~ label {
         color: #c59b08;
         }
         .star-rating-complete{
            color: #c59b08;
         }
         .rating-container .form-control:hover, .rating-container .form-control:focus{
         background: #fff;
         border: 1px solid #ced4da;
         }
         .rating-container textarea:focus, .rating-container input:focus {
         color: #000;
         }
         .rated {
         float: left;
         height: 46px;
         padding: 0 10px;
         }
         .rated:not(:checked) > input {
         position:absolute;
         display: none;
         }
         .rated:not(:checked) > label {
         float:right;
         width:1em;
         overflow:hidden;
         white-space:nowrap;
         cursor:pointer;
         font-size:30px;
         color:#ffc700;
         }
         .rated:not(:checked) > label:before {
         content: '★ ';
         }
         .rated > input:checked ~ label {
         color: #ffc700;
         }
         .rated:not(:checked) > label:hover,
         .rated:not(:checked) > label:hover ~ label {
         color: #deb217;
         }
         .rated > input:checked + label:hover,
         .rated > input:checked + label:hover ~ label,
         .rated > input:checked ~ label:hover,
         .rated > input:checked ~ label:hover ~ label,
         .rated > label:hover ~ input:checked ~ label {
         color: #c59b08;
         }
</style>  
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
                    </div>
                </div>

                <div class="pt-4 ">
                    <h2 style="font-size: 30px;color: black;font-weight: bold;text-align: center;">Reviews</h1>

                    <div class="text-center pt-5">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#reviewModal">
                            Write Your Review
                        </button>
                    </div>

                    @foreach ($ratings as $rating)
                        <div class="container">
                            <div class="row">
                                <div class="col mt-4">
                                        <p class="font-weight-bold ">Review</p>
                                        <div class="form-group row">
                                        <div>{{ $rating->user_id }}</div>
                                        <div class="col">
                                            <div class="rated">
                                            @for($i=1; $i<=$rating->rate; $i++)
                                                {{-- <input type="radio" id="star{{$i}}" class="rate" name="rating" value="5"/> --}}
                                                <label class="star-rating-complete" title="text">{{$i}} stars</label>
                                            @endfor
                                            </div>
                                        </div>
                                        </div>
                                        <div class="form-group row mt-4">
                                        <div class="col">
                                            <p>{{ $rating->comments }}</p>
                                        </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

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

                <div class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="reviewModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="reviewModalLabel">Review</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form class="container" method="POST" action="{{ route('room-rating', [$room->id]) }}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="rate">
                                                <input type="radio" id="star5" class="rate" name="rating" value="5"/>
                                                <label for="star5" title="5 Star">5 stars</label>
                                                <input type="radio" checked id="star4" class="rate" name="rating" value="4"/>
                                                <label for="star4" title="4 Star">4 stars</label>
                                                <input type="radio" id="star3" class="rate" name="rating" value="3"/>
                                                <label for="star3" title="3 Star">3 stars</label>
                                                <input type="radio" id="star2" class="rate" name="rating" value="2">
                                                <label for="star2" title="2 Star">2 stars</label>
                                                <input type="radio" id="star1" class="rate" name="rating" value="1"/>
                                                <label for="star1" title="1 Star">1 star</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row pt-4">
                                        <div class="col-12">
                                            <strong>Review :</strong>
                                            <input type="text" class="form-control" name="review">
                                        </div>
                                    </div>
                                    <div class="row pt-4">
                                        <div class="col-12 d-grid gap-2">
                                            <button type="submit" class="btn btn-primary">Rate</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    
    @include('footer')
</html>
