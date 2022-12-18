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
        // Query to get room reservation that created by the agent
        $reservations = Reservation::whereRelation('room', 'agent_id', Auth::guard('web_agent')->user()->id)->get();
    
        return view('agent.reservation-index', [
            'reservations' => $reservations
        ]);        
    }

    public function approve(Request $request, $reservationId)
    {   
        // Query to get room reservation where the reservation status is pending approval
        $reservation = Reservation::where('id', $reservationId)
            ->where('status', Reservation::STATUS_TYPE_PENDING_APPROVAL)
            ->first();

        // Update reservation status to approved 
        $reservation->status = Reservation::STATUS_TYPE_APPROVED;
        $reservation->save();
        
        return redirect()->route('agent.reservation-index');
    }

    public function reject(Request $request, $reservationId)
    {   
        // This configures a validator to validate the request
        $validator = Validator::make(
            $request->all(),
            [
                'remark' => ['required','string'],
            ]
        );

        // If validating input is not fail 
        if (!$validator->fails()) {
            // Query to get room reservation where the reservation status is pending approval
            $reservation = Reservation::where('id', $reservationId)
                ->where('status', Reservation::STATUS_TYPE_PENDING_APPROVAL)
                ->first();
            // Update reservation status to reject 
            $reservation->status = Reservation::STATUS_TYPE_REJECTED;
            // Update reservation reject remark
            $reservation->remark = $request->get('remark');
            $reservation->save(); 
            return redirect()->back()->with('flash_msg_success','Your feedback has been submitted Successfully,');        
        }

        $viewData = [
            'errors' => !empty($validator) ? $validator->errors()->getMessages() : []
        ];
        return redirect()->route('agent.reservation-index')->with($viewData);
    }
}
