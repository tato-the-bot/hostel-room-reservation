<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Feedback;
use Illuminate\Support\Facades\Auth;

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
            $feedbacks->comments = $request->get('comments');
            if(Auth::guard('web_student')->user()!= NULL){
                $feedbacks->student_id = Auth::guard('web_student')->user()->id;
                $feedbacks->role = 'STUDENT' ;
            }else if(Auth::guard('web_agent')->user()!= NULL){
                $feedbacks->student_id = Auth::guard('web_agent')->user()->id;
                $feedbacks->role = 'AGENT' ;
            }
            $feedbacks->save();
            return redirect()->back()->with('flash_msg_success','Your feedback has been submitted Successfully,');        
        }

        $viewData = [
            'errors' => !empty($validator) ? $validator->errors()->getMessages() : []
        ];

        return redirect()->back()->with($viewData);    
    }

}
