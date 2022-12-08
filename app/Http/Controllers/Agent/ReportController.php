<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Reservation;
use App\Models\Room;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $agent = Auth::guard('web_agent')->user();

        $totalTransactionAmount = Transaction::whereRelation('reservation.room', 'agent_id', $agent->id)->sum('amount');

        $totalReservations = Reservation::whereRelation('room', 'agent_id', $agent->id)->count();

        $viewData = [
            'totalTransactionAmount' => $totalTransactionAmount,
            'totalReservations' => $totalReservations
        ];

        return view('agent.report-index', $viewData);
    }

    public function transactionsAll(Request $request)
    {
        $agent = Auth::guard('web_agent')->user();

        $transactions = Transaction::whereRelation('reservation.room', 'agent_id', $agent->id)->get();
        $totalTransactionAmount = Transaction::whereRelation('reservation.room', 'agent_id', $agent->id)->sum('amount');

        $viewData = [
            'transactions' => $transactions,
            'totalTransactionAmount' => $totalTransactionAmount
        ];

        return view('agent.report-transactions-all', $viewData);
    }

    public function reservationsAll(Request $request)
    {
        $agent = Auth::guard('web_agent')->user();
        
        $rooms = Room::where('agent_id', $agent->id)->get();

        $totalReservations = Reservation::whereRelation('room', 'agent_id', $agent->id)->count();

        $viewData = [
            'rooms' => $rooms,
            'totalReservations' => $totalReservations
        ];

        return view('agent.report-reservations-all', $viewData);
    }
}
