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
        
        @include('footer')
    </body>
</html>
