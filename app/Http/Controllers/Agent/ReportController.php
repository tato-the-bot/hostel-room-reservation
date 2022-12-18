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
        // Query to get agent details
        $agent = Auth::guard('web_agent')->user();

        // Query to get total transaction amount made for agent
        $totalTransactionAmount = Transaction::whereRelation('reservation.room', 'agent_id', $agent->id)->sum('amount');

        // Query to get total room reservation where the room is created by the agent
        $totalReservations = Reservation::whereRelation('room', 'agent_id', $agent->id)->count();

        $viewData = [
            'totalTransactionAmount' => $totalTransactionAmount,
            'totalReservations' => $totalReservations
        ];

        return view('agent.report-index', $viewData);
    }

    public function transactionsAll(Request $request)
    {
        // Query to get agent details
        $agent = Auth::guard('web_agent')->user();

        // Query to get transaction made for agent
        $transactions = Transaction::whereRelation('reservation.room', 'agent_id', $agent->id)->get();
        // Query to get total transaction amount made for agent
        $totalTransactionAmount = Transaction::whereRelation('reservation.room', 'agent_id', $agent->id)->sum('amount');

        $viewData = [
            'transactions' => $transactions,
            'totalTransactionAmount' => $totalTransactionAmount
        ];

        return view('agent.report-transactions-all', $viewData);
    }

    public function reservationsAll(Request $request)
    {
        // Query to get agent details
        $agent = Auth::guard('web_agent')->user();
        
        // Query to get all rooms created by agent
        $rooms = Room::where('agent_id', $agent->id)->get();

        // Query to count total reservation made base on the room created by agent
        $totalReservations = Reservation::whereRelation('room', 'agent_id', $agent->id)->count();

        $viewData = [
            'rooms' => $rooms,
            'totalReservations' => $totalReservations
        ];

        return view('agent.report-reservations-all', $viewData);
    }
}
