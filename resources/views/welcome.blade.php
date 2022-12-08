<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Home</title>
        <!--        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" 
                      integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"/>
        <style>
            .rate {
                float: left;
                height: 45px;
                padding: 0 10px;
                }
                .rate:not(:checked) > input {
                position:absolute;
                display: none;
                }
                .rate:not(:checked) > label {
                float:right;
                width:0.8em;
                overflow:hidden;
                white-space:nowrap;
                cursor:pointer;
                font-size:45px;
                color:#ccc;
                }
                .rated:not(:checked) > label {
                float:right;
                width:1em;
                overflow:hidden;
                white-space:nowrap;
                cursor:pointer;
                font-size:45px;
                color:#ccc;
                }
                .rate:not(:checked) > label:before {
                content: '★';
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
        <!----main---->
        <div class="banner-area">
            <div class="content-area">
                <div class="content">
                    <h1>TUNKU ABDUL RAHMAN UNIVERSITY COLLEGE KL CAMMPUS HOSTEL</h1>
                    <section id="section-1">
                        <a id="scroll-btn" href="#section-2">
                            <button class="btn">Click View More</button>
                        </a>
                    </section>

                </div>
            </div>
        </div>

        <!----about us---->
        <section id="section-2">
            <div class="section">
                <div class="container">
                    <div class="content-section" style="float: right; width: 55%;">
                        <div class="content">
                            <div class="title">
                                <h1 style="color: #000;font-size: 40px;">Our Hostel</h1>
                            </div>
                            <h3>Hostel Management System was founded in November of 2021 by TARC students. 
                                It is a platform that provides room reservation service to a student who is finding 
                                a hostel before a new semester comes, and also provides an opportunity for the agent 
                                to rent their room. </h3>
                            <div class="button" style="margin-top: 50px;">
                                <a href="aboutUs.php" 
                                   style="background-color: #3d3d3d;
                                   padding: 12px 40px;
                                   text-decoration: none;
                                   color: #fff;
                                   font-size: 15px;
                                   letter-spacing: 1.5px;">Read More</a>
                            </div>
                        </div>
                    </div>
                    <div class="image-section" style="float: left;width: 40%">
                        <img src="{{ asset('images/myimage.png') }}" alt="about us">
                    </div>
                </div>
            </div>
        </section>

        <!--Feedback Section-->
        <section id="section-4" style="background: lightgrey;">
            <div class="section">
                <div class="container" style="padding-top:75px;">
                    <div class="title">
                        <h2 style="color: #000;font-size: 40px; text-align: center; font-weight:900;" class="text-uppercase">Rate Your Experience</h1>
                    </div>
                    <form method="POST" action="{{ route('feedback-create') }}">
                        @csrf
                        <div class="row pt-4">
                                <div class="d-flex justify-content-center">
                                    <div class="rate">
                                        <input type="radio" id="star5" class="rate" name="rate" value="5"/>
                                        <label for="star5" title="5 Star">5 stars</label>
                                        <input type="radio" id="star4" class="rate" name="rate" value="4"/>
                                        <label for="star4" title="4 Star">4 stars</label>
                                        <input type="radio" id="star3" class="rate" name="rate" value="3"/>
                                        <label for="star3" title="3 Star">3 stars</label>
                                        <input type="radio" id="star2" class="rate" name="rate" value="2">
                                        <label for="star2" title="2 Star">2 stars</label>
                                        <input type="radio" id="star1" class="rate" name="rate" value="1"/>
                                        <label for="star1" title="1 Star">1 star</label>
                                    </div>
                                </div>
                        </div>
                        <div class="row pt-4 justify-content-center">
                            <div class="col-8">
                                <strong>Name :</strong>
                                <input class="form-control" name="name" type="text">
                            </div>
                        </div>
                        <div class="row pt-4 justify-content-center">
                            <div class="col-8">
                                <strong>Comment :</strong>
                                <textarea class="form-control" name="comment" rows="4" cols="50"></textarea>
                            </div>
                        </div>
                        <div class="row pt-4 justify-content-center pb-5">
                            <div class="col-4 d-grid gap-2 text-center">    
                                <button class="btn btn-secondary" type="submit">Rate</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
        
        @include('footer')
    </body>
</html>
