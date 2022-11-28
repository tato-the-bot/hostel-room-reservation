<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Room;
use App\Models\Reservation;

class RoomController extends Controller
{
    public function index(Request $request)
    {
        $rooms = Room::where('status', Room::STATUS_ACTIVE)
            ->get();

        return view('room-index', [
            'rooms' => $rooms
        ]);
    }

    public function view(Request $request, $roomId)
    {
        $room = Room::find($roomId);

        return view('room-view', [
            'room' => $room
        ]);
    }

    public function book(Request $request, $roomId)
    {
        $room = Room::find($roomId);

        $bookingDetails = $request->validate([
            'contract_start_date' => ['required', 'date_format:Y-m-d'],
            'duration' => ['required', 'numeric'],
        ]);

        $reservation = new Reservation;
        $reservation->contract_start_date = $bookingDetails['contract_start_date'] . ' 00:00:00';
        $reservation->contract_end_date = date('Y-m-d', strtotime("+3 months", strtotime($bookingDetails['contract_start_date']))) . ' 23:59:49';
        $reservation->user_id = Auth::user()->id;
        $reservation->room_id = $room->id;
        $reservation->status = Reservation::STATUS_TYPE_PENDING_PAYMENT;

        $reservation->save();

        return redirect()->route('room-index');
    }
}
