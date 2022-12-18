<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Reservation;
use App\Models\Room;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        // Query to get total transaction amount
        $totalTransactionAmount = Transaction::sum('amount');
        // Query to count total reservation made
        $totalReservations = Reservation::count();

        $viewData = [
            'totalTransactionAmount' => $totalTransactionAmount,
            'totalReservations' => $totalReservations
        ];

        return view('admin.report-index', $viewData);
    }

    public function transactionsAll(Request $request)
    {
        // Query to get all transaction
        $transactions = Transaction::all();
        // Query to get total transaction amount
        $totalTransactionAmount = Transaction::sum('amount');

        $viewData = [
            'transactions' => $transactions,
            'totalTransactionAmount' => $totalTransactionAmount
        ];

        return view('admin.report-transactions-all', $viewData);
    }

    public function reservationsAll(Request $request)
    {
        // Query to get all rooms 
        $rooms = Room::all();
        // Query to count total reservation made
        $totalReservations = Reservation::count();

        $viewData = [
            'rooms' => $rooms,
            'totalReservations' => $totalReservations
        ];

        return view('admin.report-reservations-all', $viewData);
    }
}
