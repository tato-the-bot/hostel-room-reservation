<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Reservation;
use App\Models\Transaction;
use App\Models\User;

class ReservationController extends Controller
{
    public function index(Request $request)
    {   
        $reservations = Reservation::where('student_id', Auth::guard('web_student')->user()->id)
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
        if ($request->isMethod('POST')) {
            $reservation = Reservation::where('id', $reservationId)
                ->where('status', Reservation::STATUS_TYPE_APPROVED)
                ->first();

            if (empty($reservation)) {
                return redirect()->route('reservation-index');
            }
    
            $validator = Validator::make(
                $request->all(),
                [
                    'transaction_no' => ['required'],
                    'amount' => ['required'],
                ]
            );

            if (!$validator->fails()) {
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

                return redirect()->route('reservation-index');
            }
        }

        return redirect()->route('reservation-index');
    }
}
