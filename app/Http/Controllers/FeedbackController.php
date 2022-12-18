<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Feedback;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    // Function to store feedbacks 
    public function store(Request $request)
    {
        // Validate input
        $validator = Validator::make(
            $request->all(),
            [
                'rate' => ['required'],
                'name' => ['required','string'],
                'comment' => ['nullable', 'string'],
            ]
        );
        // If validating input is not fail 
        if (!$validator->fails()) {
            // Create new feedback array to store 
            $feedbacks = new Feedback;
            $feedbacks->name = $request->get('name');
            $feedbacks->rate = $request->get('rate');
            $feedbacks->comments = $request->get('comments');
            // If is Logged In and it's student then add student id and role = "student"
            if(Auth::guard('web_student')->user()!= NULL){
                $feedbacks->student_id = Auth::guard('web_student')->user()->id;
                $feedbacks->role = 'STUDENT' ;
            // If is Logged In and it's agent then add agent id and role = "agent"
            }else if(Auth::guard('web_agent')->user()!= NULL){
                $feedbacks->student_id = Auth::guard('web_agent')->user()->id;
                $feedbacks->role = 'AGENT' ;
            }
            // Save array into database
            $feedbacks->save();
            // Redirect user back with success msg
            return redirect()->back()->with('flash_msg_success','Your feedback has been submitted Successfully,');        
        }

        // If validating input is fail then get error msg 
        $viewData = [
            'errors' => !empty($validator) ? $validator->errors()->getMessages() : []
        ];
        
        // Redirect user back with error msg (if theres one)
        return redirect()->back()->with($viewData);    
    }

}
