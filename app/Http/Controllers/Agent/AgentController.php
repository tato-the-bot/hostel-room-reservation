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
        $agent = Agent::where('id', Auth::guard('web_agent')->user()->id)
            ->first();

        return view('agent.profile-view', [
            'agent' => $agent
        ]);
    }

    public function update(Request $request)
    {

        if ($request->isMethod('POST')) {
            $validator = Validator::make(
                $request->all(),
                [   
                    'image' => ['nullable','image','mimes:jpeg,png,jpg,gif,svg','max:2048'],
                    'name' => ['required','string'],
                    'email' => ['required','email'],
                    'phone_number' => ['required', 'string'],
                ]
            );

            if (!$validator->fails()) {
                $agent = Agent:: where('id', Auth::guard('web_agent')->user()->id)
                    ->first();

                if ($request->image != NULL){
                    $imageName = time().'.'.$request->image->extension();  
                    $request->image->move(public_path('storage/images'), $imageName);
                    $imgURL = '/storage/images/'.$imageName;
                } else if($agent->image != NULL){
                    $imgURL = $agent->image;
                }else{
                    $imgURL = NULL;
                }

                $agent->name = $request->get('name');
                $agent->email = $request->get('email');
                $agent->phone_number = $request->get('phone_number');
                $agent->image = $imgURL;

                $agent->save();
                
                return redirect()->route('agent.profile-view');
            }
        }

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
                $isValid = Auth::validate([
                    'password' => $request->post('old_password'),
                    'email' => Auth::user()->email,
                ]);

                if($isValid){
                    $agent->password = Hash::make($request->post('password'));
                    $agent->save();
    
                    $request->session()->forget('password_reset_agent');
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

        return view('agent.change-password', $viewData);
    }

    public function delete(Request $request)
    {
        $errors = [];
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
                $isValid = Auth::validate([
                    'password' => $request->post('password'),
                    'email' => Auth::user()->email,
                ]);

                if($isValid){
                    $agent->status = Agent::STATUS_FREEZE;
                    $agent->save();
    
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
