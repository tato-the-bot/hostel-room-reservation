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
        $rooms = Room::where('status', Room::STATUS_ACTIVE)
            ->get();

        return view('room-index', [
            'rooms' => $rooms
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

        if ($validator->fails()) {
            dd($validator->errors());
        }

        $reservation = new Reservation;
        $reservation->contract_start_date = $request->get('contract_start_date') . ' 00:00:00';
        $reservation->contract_end_date = date('Y-m-d', strtotime('+' . $request->get('duration') . ' months', strtotime($request->get('contract_start_date')))) . ' 23:59:49';
        $reservation->student_id = Auth::guard('web_student')->user()->id;
        $reservation->room_id = $room->id;
        $reservation->status = Reservation::STATUS_TYPE_PENDING_APPROVAL;

        $reservation->save();

        return redirect()->route('room-index');
    }
}
