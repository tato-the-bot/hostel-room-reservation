<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Room;
use App\Models\Rating;
use Illuminate\Support\Facades\Validator;

class RatingController extends Controller
{

    public function store(Request $request, $roomId)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'rating' => ['required'],
                'review' => ['nullable', 'string'],
            ]
        );

        if (!$validator->fails()) {

            $review = new Rating;
            $review->student_id = Auth::guard('web_student')->user()->id;
            $review->room_id = $roomId;
            $review->rate = $request->get('rating');
            $review->comments = $request->get('review');
            $review->save();
            return redirect()->back()->with('flash_msg_success','Your review has been submitted Successfully,');
        }
            
        $viewData = [
            'errors' => !empty($validator) ? $validator->errors()->getMessages() : []
        ];

        return redirect()->back()->with($viewData);        
    }
}
