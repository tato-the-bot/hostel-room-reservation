<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Reservation;
use App\Models\Room;


class ReservationController extends Controller
{
    public function index(Request $request)
    {   
        $reservations = Reservation::whereRelation('room', 'agent_id', Auth::guard('web_agent')->user()->id)->get();
    
        return view('agent.reservation-index', [
            'reservations' => $reservations
        ]);        
    }

    public function approve(Request $request, $reservationId)
    {   
        $reservation = Reservation::where('id', $reservationId)
            ->where('status', Reservation::STATUS_TYPE_PENDING_APPROVAL)
            ->first();

        $reservation->status = Reservation::STATUS_TYPE_APPROVED;
        $reservation->save();
        
        return redirect()->route('agent.reservation-index');
    }

    public function reject(Request $request, $reservationId)
    {   
        $reservation = Reservation::where('id', $reservationId)
            ->where('status', Reservation::STATUS_TYPE_PENDING_APPROVAL)
            ->first();

        $reservation->status = Reservation::STATUS_TYPE_REJECTED;
        $reservation->save();
        
        return redirect()->route('agent.reservation-index');
    }
}
