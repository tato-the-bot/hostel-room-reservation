<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Reservation;
use App\Models\User;

class ReservationController extends Controller
{
    public function index(Request $request)
    {   
        $reservations = Reservation::where('user_id', Auth::user()->id)
            ->get();

        return view('reservation-index', [
            'reservations' => $reservations
        ]);        
    }

    public function update(Request $request, $reservationId)
    {   
        $reservation = Reservation::where('id', $reservationId)
            ->where('status', Reservation::STATUS_TYPE_PENDING_APPROVAL)
            ->first();

        if (empty($reservation)) {
            return redirect('/');
        }

        if ($request->isMethod('POST')) {
            $validator = Validator::make(
                $request->all(),
                [
                    'contract_start_date' => ['required', 'date_format:Y-m-d'],
                    'contract_end_date' => ['required', 'date_format:Y-m-d'],
                ]
            );
    
            if ($validator->fails()) {
                dd($validator->errors());
            }

            $reservation->contract_start_date = $request->post('contract_start_date');
            $reservation->contract_end_date = $request->post('contract_end_date');
            $reservation->remark = $request->post('remark');
            $reservation->save();
        }

        $startDate = date('Y-m-d', strtotime($reservation->contract_start_date));
        $endDate = date('Y-m-d', strtotime($reservation->contract_end_date));

        return view('reservation-update', [
            'reservation' => $reservation,
            'startDate' => $startDate,
            'endDate' => $endDate,
        ]);
    }

    public function cancel(Request $request, $reservationId)
    {   
        $reservation = Reservation::where('id', $reservationId)
            ->where('status', Reservation::STATUS_TYPE_PENDING_APPROVAL)
            ->first();

        $reservation->status = Reservation::STATUS_TYPE_CANCELLED;
        $reservation->save();
        
        return redirect()->route('reservation-index');
    }

    public function pay(Request $request, $reservationId)
    {   
        dd('placeholder payment paypal');
    }
}
