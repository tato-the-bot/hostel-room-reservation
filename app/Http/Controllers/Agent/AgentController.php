<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Agent;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\ImageUploadController;
use Illuminate\Support\Facades\Hash;

class AgentController extends Controller
{
    public function index(Request $request)
    {
        // Query to get agent details
        $agent = Agent::where('id', Auth::guard('web_agent')->user()->id)
            ->first();

        return view('agent.profile-view', [
            'agent' => $agent
        ]);
    }

    public function update(Request $request)
    {

        if ($request->isMethod('POST')) {
            // This configures a validator to validate the request.
            $validator = Validator::make(
                $request->all(),
                [   
                    'image' => ['nullable','image','mimes:jpeg,png,jpg,gif,svg','max:2048'],
                    'name' => ['required','string'],
                    'email' => ['required','email'],
                    'phone_number' => ['required', 'string'],
                ]
            );

            // If validating input is not fail 
            if (!$validator->fails()) {
                // Get agent data
                $agent = Agent:: where('id', Auth::guard('web_agent')->user()->id)
                    ->first();

                // If input image is not NULL 
                if ($request->image != NULL){
                    // change image name to current upload time
                    $imageName = time().'.'.$request->image->extension();  
                    // save image to public path
                    $request->image->move(public_path('storage/images'), $imageName);
                    // store img path into a variable
                    $imgURL = '/storage/images/'.$imageName;
                // If in agent data originally has img 
                } else if($agent->image != NULL){
                    // Keep the img
                    $imgURL = $agent->image;
                }else{
                    // If input img is NULL then the URL would be NULL (No default img)
                    $imgURL = NULL;
                }

                $agent->name = $request->get('name');
                $agent->email = $request->get('email');
                $agent->phone_number = $request->get('phone_number');
                $agent->image = $imgURL;

                // Update agent profile
                $agent->save();
                
                return redirect()->route('agent.profile-view');
            }
        }

        // Query to get admin details 
        $agent = Agent::where('id', Auth::guard('web_agent')->user()->id)
            ->first();

        $viewData = [
            'agent' => $agent,
            'errors' => !empty($validator) ? $validator->errors()->getMessages() : []
        ];

        return view('agent.profile-update', $viewData);
    }

    public function changePassword(Request $request)
    {
        $errors = [];
        // Query to get agent details 
        $agent = Agent::where('id', Auth::guard('web_agent')->user()->id)->first();

        if ($request->isMethod('POST')) {
            // This configures a validator to validate the request.
            $validator = Validator::make(
                $request->all(),
                [   
                    'password' => ['required', 'confirmed'],
                ]
            );

            if (!$validator->fails()) {
                // Validate if input matches the database
                $isValid = Auth::validate([
                    'password' => $request->post('old_password'),
                    'email' => Auth::user()->email,
                ]);
                // If match, update database
                if($isValid){
                    $agent->password = Hash::make($request->post('password'));
                    $agent->save();
    
                    $request->session()->forget('password_reset_agent');
                    return redirect()->route('home'); 
                // Else, display error
                }else{
                    $errors[] = ['The provided credentials do not match our records.'];
                }
                
            }
        }

        $viewData = [
            'errors' => $errors,
            'validate' => !empty($validator) ? $validator->errors()->getMessages() : []
        ];

        return view('agent.change-password', $viewData);
    }

    public function delete(Request $request)
    {
        $errors = [];
        // Query to get agent details
        $agent = agent::where('id', Auth::guard('web_agent')->user()->id)->first();

        if ($request->isMethod('POST')) {
            // This configures a validator to validate the request.
            $validator = Validator::make(
                $request->all(),
                [   
                    'password' => ['required'],
                ]
            );
            if (!$validator->fails()) {
                // Validate if input matches the database
                $isValid = Auth::validate([
                    'password' => $request->post('password'),
                    'email' => Auth::user()->email,
                ]);

                // If match, freeze agent account
                if($isValid){
                    $agent->status = Agent::STATUS_FREEZE;
                    $agent->save();
                    
                    // Logout the agent
                    Auth::logout();
 
                    // Stop tracking the session.
                    $request->session()->invalidate();    
                    $request->session()->regenerateToken();
                    return redirect()->route('home'); 
                }else{
                    $errors[] = ['The provided credentials do not match our records.'];
                }
                
            }
        }

        $viewData = [
            'errors' => $errors,
            'validate' => !empty($validator) ? $validator->errors()->getMessages() : []
        ];

        return view('agent.delete', $viewData);
    }
}
