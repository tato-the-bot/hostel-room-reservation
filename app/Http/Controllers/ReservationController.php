<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


use App\Models\Reservation;
use App\Models\User;

class ReservationController extends Controller
{
    public function index(Request $request)
    {   
        $reservations = Reservation::where('user_id', Auth::user()->id)
            ->get();

        return view('reservation', [
            'reservations' => $reservations
        ]);        

    }
}
