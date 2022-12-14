<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>About Us</title>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" 
              integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>
        
        <style>
            body{
                margin: 0px;
                padding: 0px;
                font-family: Arial;
                box-sizing: border-box;
            }
            /*--nav--*/
            nav{
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100px;
                padding: 10px 90px;
                box-sizing: border-box;
                background: rgb(204, 204, 255);
                z-index: 1;
            }
            nav .logo{
                padding: 22px 20px;
                height: 80px;
                float: left;
                font-size: 24px;
                font-weight: bold;
                text-transform: uppercase;
                color: #000;
            }
            nav ul{
                list-style: none;
                float: right;
                margin: 0;
                padding: 0;
                display: flex;
            }
            nav ul li a{
                line-height: 80px;
                color: #000;
                padding: 12px 30px;
                text-decoration: none;
                text-transform: uppercase;
                font-size: 15px;
                font-weight: bold;
            }
            nav ul li a:hover{
                background: rgb(247, 238, 243);
                border-radius: 6px;
            }
            nav ul li a.active{
                background: rgb(153, 0, 0);
                color: #fff;
                border-radius: 6px;
            }
            /*--content--*/
            .section{
                width: 100%;
                min-height: 70vh;
            }
            .container{
                width: 50%;
                display: block;
                /*margin: auto;*/
                padding-top: 50px;
            }
            .content-section{
                float: right;
                width: 55%;
            }
            .image-section{
                float: left;
                width: 40%
            }
            .image-section img{
                width: 100%;
                height: auto;
            }
            .content-section .title{
                text-transform: uppercase;
                font-size: 15px;
            }
            .content-section .content h3{
                color: #3d3d5c;
                font-size: 23px;
                font-family: Lucida Sans Unicode;
                padding-top: 37px;
            }
            .content-section .social{
                margin-top: 60px;
            }
            .content-section .social i{
                color: rgb(153, 0, 0);
                font-size: 30px;
                padding: 0px 10px;
            }
            /*--footer--*/
            .footer{
                background-color: #24262b;
                padding: 70px 0;
            }
            .footer .container{
                max-width: 1170px;
                margin: auto;
                padding-top: 0px;
            }
            .footer .row{
                display: flex;
                flex-wrap: wrap;
            }
            ul{
                list-style: none;
            }
            .footer-col{
                width: 22%;
                padding: 0 17px;
            }
            .footer-col h4{
                font-size: 18px;
                color: #fff;
                text-transform: capitalize;
                margin-bottom: 35px;
                font-weight: 500;
                position: relative;
            }
            .footer-col h4::before{
                content: '';
                position: absolute;
                left: 0;
                bottom: -10px;
                background-color: #e91e63;
                height: 3px;
                box-sizing: border-box;
                width: 50px;
            }
            .footer-col ul li:not(:last-child){
                margin-bottom: 10px;
            }
            .footer-col ul li a{
                font-size: 16px;
                text-transform: capitalize;
                color: #fff;
                text-decoration: none;
                font-weight: 300;
                color: #bbb;
                display: block;
                margin-left: -15%;
                transition: all 0.3s ease;
            }
            .footer-col ul li a:hover{
                color: #fff;
                padding-left: 8px;
            }
            .footer-col .social-links a{
                display: inline-block;
                height: 40px;
                width: 40px;
                background-color: rgba(255,255,255,0.2);
                margin: 0 10px 10px 0; 
                text-align: center;
                line-height: 40px;
                border-radius: 50%;
                color: #fff;
                transition: all 0.5s ease;
            }
            .footer-col .social-links a:hover{
                color: #24262b;
                background-color: #fff;
            }
        </style>
    </head>

    <body>
        @include('header')

        <div class="aboutUs" style="margin-top:150px">
            <h1 style="font-size: 30px;color: black;font-weight: bold;text-align: center;">About Us</h1>
            <hr style="width:90%;border-top: 2px groove #8c8c8c; margin-left: 75px;">
        </div>

        <div class="section"  style="margin-top:-120px;">
            <div class="container">
                <div class="content-section">
                    <div class="content">
                        <div class="title">
                            <h2>Our Hostel</h2>
                        </div>
                        <h3>Hostel Management System was founded in November of 2021 by TARC students. 
                            It is a platform that provides room reservation service to a student who is finding 
                            a hostel before a new semester comes, and also provides an opportunity for the agent 
                            to rent their room. </h3>
                    </div>
                    <div class="social">
                        <a href="https://www.facebook.com/"><i class="fab fa-facebook-f"></i></a>
                        <a href="https://twitter.com/"><i class="fab fa-twitter"></i></a>
                        <a href="https://instagram.com/"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
                <div class="image-section">
                    <img src="{{ asset('images/aboutus.jpg') }}" alt="about us">
                </div>
            </div>
        </div>

        @include('footer')
    </body>
</html>
