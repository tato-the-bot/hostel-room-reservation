<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Reports</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"/>
    </head>

    <body>
        
        @include('header')
        
        <div class="room" style="margin-top:150px">
            <h1 style="font-size: 30px;color: black;font-weight: bold;text-align: center;">Reports</h1>
            <hr style="width:90%;border-top: 2px groove #8c8c8c;margin-left: 75px;">
        </div>

        <div class="container pb-4">
            <div class="row">
                <div class="col-6">
                    <div class="card">
                        <div class="card-header">
                            Total transacted amount 
                        </div>
                        <div class="card-body">
                            <h1>RM {{ $totalTransactionAmount }}</h1>
                            <a 
                                target="popup" 
                                onclick="window.open('{{ route('admin.report-transactions-all') }}', 'newwindow', 'width=1000,height=500'); return false;"
                                href="#"
                            >
                                See transaction report
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card">
                        <div class="card-header">
                            Total reservations
                        </div>
                        <div class="card-body">
                            <h1>{{ $totalReservations }} reservations</h1>
                            <a 
                                target="popup" 
                                onclick="window.open('{{ route('admin.report-reservations-all') }}', 'newwindow', 'width=1000,height=500'); return false;"
                                href="#"
                            >
                                See reservation report
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    
    @include('footer')
</html>
