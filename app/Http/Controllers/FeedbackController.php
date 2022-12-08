<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Feedback;

class FeedbackController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'rate' => ['required'],
                'name' => ['required','string'],
                'comment' => ['nullable', 'string'],
            ]
        );

        if (!$validator->fails()) {
            $feedbacks = new Feedback;
            $feedbacks->name = $request->get('name');
            $feedbacks->rate = $request->get('rate');
            $feedbacks->comments = $request->get('feedback');
            $feedbacks->save();
            return redirect()->back()->with('flash_msg_success','Your feedback has been submitted Successfully,');        
        }

        $viewData = [
            'errors' => !empty($validator) ? $validator->errors()->getMessages() : []
        ];

        return redirect()->back()->with($viewData);    
    }

}
