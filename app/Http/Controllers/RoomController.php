<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Room;

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
}
