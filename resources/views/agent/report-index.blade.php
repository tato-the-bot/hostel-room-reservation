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
    </head>

    <body>
        
        @include('header')
        
        <div class="room" style="margin-top:150px">
            <h1 style="font-size: 30px;color: black;font-weight: bold;text-align: center;">Reports</h1>
            <hr style="width:90%;border-top: 2px groove #8c8c8c;">
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
                                onclick="window.open('{{ route('agent.report-transactions-all') }}', 'newwindow', 'width=1000,height=500'); return false;"
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
                                onclick="window.open('{{ route('agent.report-reservations-all') }}', 'newwindow', 'width=1000,height=500'); return false;"
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
