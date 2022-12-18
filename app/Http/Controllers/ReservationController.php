<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Reservation;
use App\Models\Room;
use App\Models\Transaction;
use App\Models\User;

class ReservationController extends Controller
{
    public function index(Request $request)
    {   
        // query to get all reservation made by student
        $reservations = Reservation::where('student_id', Auth::guard('web_student')->user()->id)
            ->get();

        return view('reservation-index', [
            'reservations' => $reservations
        ]);        
    }

    public function update(Request $request, $reservationId)
    {   
        // query to get reservation where status is pending approval
        $reservation = Reservation::where('id', $reservationId)
            ->where('status', Reservation::STATUS_TYPE_PENDING_APPROVAL)
            ->first();

        // If no reservation were made then return to home
        if (empty($reservation)) {
            return redirect('/');
        }

        if ($request->isMethod('POST')) {
            // This configures a validator to validate the request
            $validator = Validator::make(
                $request->all(),
                [
                    'contract_start_date' => ['required', 'date_format:Y-m-d'],
                    'contract_end_date' => ['required', 'date_format:Y-m-d'],
                    'remark' => ['string', 'nullable']
                ]
            );
            // If validating input is not fail 
            if (!$validator->fails()) {
                $reservation->contract_start_date = $request->post('contract_start_date');
                $reservation->contract_end_date = $request->post('contract_end_date');
                $reservation->remark = $request->post('remark');
                $reservation->save();
            }
        }
        // change date format
        $startDate = date('Y-m-d', strtotime($reservation->contract_start_date));
        $endDate = date('Y-m-d', strtotime($reservation->contract_end_date));

        $viewData = [
            'reservation' => $reservation,
            'startDate' => $request->post('contract_start_date') ?? $startDate,
            'endDate' => $request->post('contract_end_date') ?? $endDate,
            'remark' => $request->post('remark') ?? $reservation->remark,
            'errors' => !empty($validator) ? $validator->errors()->getMessages() : []
        ];

        return view('reservation-update', $viewData);
    }

    public function cancel(Request $request, $reservationId)
    {   
        // Query to get reservation
        $reservation = Reservation::where('id', $reservationId)
            ->where('status', Reservation::STATUS_TYPE_PENDING_APPROVAL)
            ->first();

        // update reservation status to cancel
        $reservation->status = Reservation::STATUS_TYPE_CANCELLED;
        $reservation->save();
        
        return redirect()->route('reservation-index');
    }

    public function pay(Request $request, $reservationId)
    {   
        if ($request->isMethod('POST')) {
            // Query to get reservation where status is approve
            $reservation = Reservation::where('id', $reservationId)
                ->where('status', Reservation::STATUS_TYPE_APPROVED)
                ->first();

            // If reservation is empty, redirect to reservation index page
            if (empty($reservation)) {
                return redirect()->route('reservation-index');
            }
            // This configures a validator to validate the request.
            $validator = Validator::make(
                $request->all(),
                [
                    'transaction_no' => ['required'],
                    'amount' => ['required'],
                ]
            );

            // If validation fails, do something.
            if (!$validator->fails()) {
                // create empty transaction object for new transaction
                $transaction = new Transaction;

                $transaction->transaction_no = $request->post('transaction_no');
                $transaction->amount = $request->post('amount');
                $transaction->invoice_no = $reservation->id . '-' . date('YmdHis');
                $transaction->reservation_id = $reservation->id;
                $transaction->pay_method = 'paypal';
                $transaction->save();
                $transaction->refresh();

                $reservation->transaction_id = $transaction->id;
                $reservation->status = Reservation::STATUS_TYPE_PAID_DEPOSIT;
                $reservation->save();

                $room = Room::where('id', $reservation->room_id)
                    ->first();  
                // update room status to reserved
                $room->status = Room::STATUS_RESERVED;
                $room->save();

                return redirect()->route('reservation-index');
            }
        }

        return redirect()->route('reservation-index');
    }
}
