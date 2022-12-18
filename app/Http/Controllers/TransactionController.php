<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Agent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    public function invoice(Request $request, $transactionId)
    {
        // query to get student ID
        $studentId = Auth::guard('web_student')->user()->id;

        // query to get transaction made by student
        $transaction = Transaction::where('id', $transactionId)
            ->whereRelation('reservation', 'student_id', $studentId)
            ->first();

        // query to get agent ID thru the transaction made by student
        $agent = Agent::find($transaction->reservation->room->agent_id);
        // query to get room details thru transaction made by student
        $room = $transaction->reservation->room;

        if ($transaction) {
            $viewData = [
                'transaction' => $transaction,
                'reservation' => $transaction->reservation,
                'payee' => Auth::guard('web_student')->user(),
                'agent' => $agent,
                'room' => $room,
            ];

            return view('invoice', $viewData);
        }

        return redirect()->route('home');
    }
}
