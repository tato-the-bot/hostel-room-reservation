<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Reservations</title>
    </head>

    <body>
        
        @include('header')
        
        <div class="room" style="margin-top:150px">
            <h1 style="font-size: 30px;color: black;font-weight: bold;text-align: center;">Reservations</h1>
            <hr style="width:90%;border-top: 2px groove #8c8c8c;">
        </div>
        
        <form class="container pb-4" method="POST" action="{{ route('reservation-update', [$reservation->id]) }}">
            @if(count($errors) > 0) 
                <div class="alert alert-danger">
                    @foreach ($errors as $error) 
                        <div>{{$error[0]}}</div>
                    @endforeach
                </div>
            @endif

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
                    {{ $reservation->room->id }}
                </div>
                <div class="col-6">
                    {{ \App\Models\Room::ROOM_TYPE_LABEL[$reservation->room->room_type] }}
                </div>
            </div>

            <div class="row pt-4">
                <div class="col-6">
                    <strong>Start at:</strong>
                </div>
                <div class="col-6">
                    <strong>End at:</strong>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <input type="date" class="form-control" name="contract_start_date" value="{{ $startDate }}" required>
                </div>
                <div class="col-6">
                    <input type="date" class="form-control" name="contract_end_date" value="{{ $endDate }}" required>
                </div>
            </div>

            <div class="row pt-4">
                <div class="col-6">
                    <strong>Remarks:</strong>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <textarea class="form-control" name="remark" rows="3">{{ $remark }}</textarea>
                </div>
            </div>

            <div class="row pt-4">
                <div class="col-12">
                    <strong>Deposit:</strong> RM {{ $reservation->room->deposit }}
                </div>
            </div>

            <div class="row pt-4">
                <div class="col-6 d-grid gap-2">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
                <div class="col-6 d-grid gap-2">
                    <a href="{{ route('reservation-cancel', [$reservation->id]) }}" class="btn btn-warning">Cancel Reservation</a>
                </div>
            </div>
        </form>
    </body>
    @include('footer')
</html>
