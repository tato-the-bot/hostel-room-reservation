<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Room;
use App\Models\Reservation;
use App\Models\Rating;
use Illuminate\Support\Facades\Validator;

class RoomController extends Controller
{
    public function index(Request $request)
    {
        $roomQuery = Room::where('status', Room::STATUS_ACTIVE);

        if ($request->get('room_type')) {
            $roomQuery->where('room_type', $request->get('room_type'));
        }

        if ($request->get('location')) {
            $roomQuery->where('location', $request->get('location'));
        } 

        if ($request->get('search')) {
            $roomQuery->where('room_title', 'LIKE', '%' . $request->get('search') . '%');
        } 
        
        $rooms = $roomQuery->get();

        return view('room-index', [
            'rooms' => $rooms,
            'room_type' => $request->get('room_type'),
            'location' => $request->get('location'),
            'search' => $request->get('search'),
        ]);
    }

    public function view(Request $request, $roomId)
    {
        $room = Room::find($roomId);

        $ratings = Rating::where('room_id', $roomId)
            ->get();

        return view('room-view', [
            'room' => $room,
            'ratings'=> $ratings,
        ]);
    }

    public function book(Request $request, $roomId)
    {
        $room = Room::find($roomId);

        $validator = Validator::make(
            $request->all(),
            [
                'contract_start_date' => ['required', 'date_format:Y-m-d'],
                'duration' => ['required', 'numeric'],
            ]
        );

        if (!$validator->fails()) {
            $reservation = new Reservation;
            $reservation->contract_start_date = $request->get('contract_start_date') . ' 00:00:00';
            $reservation->contract_end_date = date('Y-m-d', strtotime('+' . $request->get('duration') . ' months', strtotime($request->get('contract_start_date')))) . ' 23:59:49';
            $reservation->student_id = Auth::guard('web_student')->user()->id;
            $reservation->room_id = $room->id;
            $reservation->status = Reservation::STATUS_TYPE_PENDING_APPROVAL;

            $reservation->save();

            return redirect()->route('room-index');
        }

        return redirect()->route('room-view', $roomId);
    }
}
