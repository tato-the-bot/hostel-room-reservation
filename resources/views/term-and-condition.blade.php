<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Term and Condition</title>
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
            <h1 style="font-size: 30px;color: black;font-weight: bold;text-align: center;">Terms & Conditions</h1>
            <hr style="width:80%;border-top: 2px groove #8c8c8c; margin-left: 140px;">
        </div>

        <div class="section"  style="margin-top:-170px;">
            <div class="container">

                <h5>Use of our website</h5>
                <p>The use of Hostel Management website is subject to the terms and conditions set forth below. 
                    Please read the following Website Terms and Conditions, which relate to information regarding 
                    general use of our websites. By using our websites, you are agreeing to these Terms and Conditions 
                    whether as a guest or registered user. By using our sites you are indicating you accept these terms 
                    of use and that you agree to abide by them. From time to time we may change these Terms and Conditions, 
                    and will post revisions on this website. We recommend that you read these Terms and Conditions prior to 
                    using our sites and thereafter regularly review any changes and you are responsible for doing so.</p>

                <h5>Rules and Regulation</h5>
                <p>1. Our system temporarily only accepts hostel or dormitory reservations for full-time students.<br>
                    2. The University College and Hostel Management reserve the right to reject any hostel application.<br>
                    3. Reservation refers to an application for submission, approval, payment of deposit, and registration 
                    (check-in) within the specified time.</p>

                <h5>Intellectual Property</h5>
                <p>The content, layout, design, data, databases and graphics on this website are protected by Malaysian 
                    and other international intellectual property laws and licensors. Unless expressly permitted in writing 
                    in a licence agreement , no part of the website may be reproduced, stored in any medium, including but not 
                    limited to a retrieval system or transmitted, in any form or by any means (electronic, mechanical, photocopying, 
                    recording, broadcasting) nor, shown in public other than websites.<br><br>
                    Any material you upload to our site will be deemed non-confidential and non-proprietary (unless otherwise 
                    stated on the site or in our Privacy Policy), and you grant us a transferable, royalty-free, worldwide, 
                    irrevocable license to use, reproduce, distribute, edit, modify, disclose, sublicense to third parties and 
                    create derivative works of any such material, in whole or in part, in any medium, for any purpose. We may remove,
                    edit or modify any such material at any time without notice to you. To the fullest extent permitted by law, moral 
                    rights attach to any material and we waive those rights.<br><br>
                    We also reserve the right to disclose your identity to any third party who claims that any material you post or 
                    upload to any of our Sites violates their rights, including but not limited to their intellectual property rights,
                    rights of reputation, or their rights to privacy.</p>

                <h5>Prohibited Conducts</h5>
                <p>You agree that you shall not:<br>
                    - Directly or indirectly attempt or actually disrupt, impair or interfere with, alter or modify Hostel 
                    Management's Website Content. </p>

                <h5>Legal Disclaimer For Web Site Content</h5>
                <p style="padding-bottom: 50px">Information on this Web site is provided for information purposes only. Any information obtained from this 
                    Web site should be reviewed by an appropriate authority to determine its applicability to your particular needs. 
                    Great care has been taken to maintain the accuracy of the information provided on this Web site. However, 
                    Hostel Management and their employees are not responsible for errors or any untoward consequences arising from 
                    your use of this information.</p>

            </div>
        </div>
        @include('footer')
    </body>
</html>