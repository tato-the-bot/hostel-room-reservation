<html>
    <head>
        <meta charset="UTF-8">
        <title>About Us</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

         <style>
            body{
                margin: 0px;
                padding: 0px;
                font-family: Arial;
                box-sizing: border-box;
            }
            /*--navigate--*/
            nav .logo{
                padding: 22px 20px;
                height: 80px;
                float: left;
                font-size: 24px;
                font-weight: bold;
                text-transform: uppercase;
                color: #000;
            }
            

            @if (Auth::guard('web_student')->user() || Auth::guard('web_agent')->user() || Auth::guard('web_admin')->user())
                    @if (Auth::guard('web_student')->user())
                    nav{
                        z-index: 100;
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
                    @elseif (Auth::guard('web_agent')->user())
                    nav{
                        z-index: 100;
                        position: fixed;
                        top: 0;
                        left: 0;
                        width: 100%;
                        height: 100px;
                        padding: 10px 90px;
                        box-sizing: border-box;
                        background: rgb(249, 255, 133);
                        z-index: 1;
                    }
                    @elseif (Auth::guard('web_admin')->user())
                    nav{
                        z-index: 100;
                        position: fixed;
                        top: 0;
                        left: 0;
                        width: 100%;
                        height: 100px;
                        padding: 10px 90px;
                        box-sizing: border-box;
                        background: rgb(249, 92, 39);
                        z-index: 1;
                    }
                    @endif
            @else
            nav{
                z-index: 100;
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
            @endif

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
            /*--home page--*/
            .banner-area{
                width: 100%;
                height: 100vh;
                background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('images/tarcklcampus.jpg');
                background-size: cover;
            }
            .content-area{
                height: 100%;
                width: 50%;
                padding-top: 3%;
                margin-left: 27%;
                display: flex;
                justify-content: center;
                align-items: center;
            }
            .content{
                text-align: center;
            }
            .content h1{
                font-size: 60px;
                color: #fff;
            }
            .content .btn{
                border: none;
                outline: none;
                padding: 15px;
                margin-top: 80px;
                border-radius: 4px;
                color:#eee;
                font-size: 18px;
                font-weight: bold;
                cursor: pointer;
                background:rgb(153, 0, 0);
            }
            /*--scroll & about us--*/
            .section{
                width: 100%;
                min-height: 90vh;
            }
            .section .container{
                width: 80%;
                display: block;
                margin: auto;
                padding-top: 200px;
            }
            .image-section img{
                width: 100%;
                height: auto;
            }
            .content-section .title{
                text-transform: uppercase;
                font-size: 5px;
            }
            .content-section .content h3{
                margin-top: 15px;
                color: #3d3d5c;
                font-family: Lucida Sans Unicode;
            }
            .content-section.content.button2 a:hover{
                background-color: #a52a2a;
                color: #fff;
            }
            /*--footer--*/
            .footer{
                background-color: #24262b;
                padding: 70px 0;
            }
            .footer .container{
                max-width: 1170px;
                margin: auto;
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
                height: 2px;
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
            .chat-bubble {
                position: fixed;
                bottom: 10px;
                right: 10px;
                width: 80px;
                height: 80px;
                background-color: #eee;
                border-radius: 40px;
                z-index: 100;
            }
            .chat-bubble img {
                display: block;
                margin: 0 auto;
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                max-width: 80px;
                max-height: 80px;
                border-radius: 40px;
            }
        </style>
    </head>

    <body>
        <div class="chat-bubble">
            <a href="{{ route('chatbot') }}"><img src="{{ asset('images/chatbot.jpg') }}"></a>
        </div>
          <!----navigate---->
        <nav>
            <div class="logo">Hostel Management System</div>
            <ul>
                <li><a href="/">Home</a></li>
                <li><a href="{{ route('about-us') }}">About Us</a></li>

                @if (Auth::guard('web_student')->user() || Auth::guard('web_agent')->user() || Auth::guard('web_admin')->user())

                        @if (Auth::guard('web_student')->user())
                            <li><a href="{{ route('room-index') }}">Rooms</a></li>
                            <li><a href="{{ route('reservation-index') }}">Profile</a></li>
                        @elseif (Auth::guard('web_agent')->user())
                            <li><a href="{{ route('agent.room-index') }}">Rooms</a></li>
                            <li><a href="{{ route('agent.report-index') }}">Reports</a></li>
                            <li><a href="{{ route('agent.reservation-index') }}">Profile</a></li>
                        @elseif (Auth::guard('web_admin')->user())
                            <li><a href="{{ route('admin.feedback-index') }}">Feedbacks</a></li>
                            <li><a href="{{ route('admin.report-index') }}">Reports</a></li>
                            <li><a href="{{ route('admin.users-index') }}">Users</a></li>
                        @endif

                    <li><a href="{{ route('logout') }}">Logout</a></li>
                @else
                    <li><a href="{{ route('login') }}">Login</a></li>
                @endif
            </ul>
        </nav>
    </body>
</html>