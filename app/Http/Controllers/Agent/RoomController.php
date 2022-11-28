<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Room;

class RoomController extends Controller
{
    public function index(Request $request)
    {
        $rooms = Room::where('user_id', Auth::user()->id)
            ->get();

        return view('agent.room-index', [
            'rooms' => $rooms
        ]);
    }

    public function update(Request $request, $roomId)
    {
        dd("Room Update Page placeholder " . $roomId);
    }

    public function delete(Request $request, $roomId)
    {
        $rooms = Room::where('user_id', Auth::user()->id)
            ->where('id', $roomId)
            ->delete();

        return redirect()->route('agent.room-index');
    }

    public function create(Request $request)
    {
        if ($request->isMethod('POST')) {

            $validator = Validator::make(
                $request->all(),
                [
                    'room_title' => ['required','string'],
                    'room_type' => ['required'],
                    'room_desc' => ['nullable', 'string'],
                    'monthly_rental' => ['required'],
                    'deposit' => ['required'],
                    'image' => ['nullable','string'],
                    'remark' => ['nullable','string'],
                ]
            );

            if ($validator->fails()) {
                dd($validator->errors());
            }
            
            $room = new Room;
            $room->room_title = $request->get('room_title');
            $room->room_type = $request->get('room_type');
            $room->room_desc = $request->get('room_desc') ;
            $room->monthly_rental = $request->get('monthly_rental');
            $room->deposit = $request->get('deposit');
            $room->image = $request->get('image');
            $room->remark = $request->get('remark');

            $room->status = 0;
            $room->user_id = Auth::user()->id;
    
            $room->save();
            
            return redirect()->route('agent.room-index');
        }

        return view('agent.room-create');
    }    
}
