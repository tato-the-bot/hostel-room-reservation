<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Room;
use App\Models\Rating;

class RatingController extends Controller
{
    public function index(Request $request, $roomId)
    {
        // Query to get rating on the specific room 
        $ratings = Rating::where('room_id', $roomId)
            ->get();

        return view('agent.rating-index', [
            'ratings' => $ratings
        ]);
    }

}
