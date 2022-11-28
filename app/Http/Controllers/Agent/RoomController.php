<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        dd('Agent create room placeholder');
    }
}
