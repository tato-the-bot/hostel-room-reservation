<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>FAQs</title>
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
            <h1 style="font-size: 30px;color: black;font-weight: bold;text-align: center;">FAQ's</h1>
            <hr style="width:80%;border-top: 2px groove #8c8c8c; margin-left: 140px;">
        </div>

        <div class="section"  style="margin-top:-170px;">
            <div class="container">

                <h6 style=" font-weight: bold">1. What payment method can be used in this system?</h6>
                <p>The Hostel Reservation System is only available for payment via Paypal.</p>
                
                <h6 style=" font-weight: bold">2. How to I join as an agent?</h6>
                <p>Before you select the "login by customer" button, select "login by agent" button
                and Sign up a new account to conduct your business.</p>
                
                <h6 style=" font-weight: bold">3. How can I be sure of my data security with this hostel management system?</h6>
                <p>With our hostel management software, you can be completely sure about the safety of your data. 
                    Our servers hold the highest level of security with respect to industry standards. 
                    This is why no direct access can be acquired without proper authentication.</p>
                
                <h6 style=" font-weight: bold">4. I have hostels located across different countries. 
                    Will this hostel software support different regional tax subjections?</h6>
                <p>No, the hostel management software currently cannot supports the respective taxes that the regions are subjected to.</p>
                
                <h6 style=" font-weight: bold">5. Can this property management system for hostels help us manage the extra services we offer?</h6>
                <p>No.</p>
                
                <h6 style=" font-weight: bold">6. How do I promote my hostel?</h6>
                <p>You can add an image of your hostel along with relevant information and details about your room. 
                    Then, the system will automatically appear your hostel/room on the home page and room page.</p>
                
                <h6 style=" font-weight: bold">7. Can we make monthly rental fees through this website?</h6>
                <p style="padding-bottom: 50px">No, this system only accepts paying the deposit after making a reservation.</p>

            </div>
        </div>
        @include('footer')
    </body>
</html>