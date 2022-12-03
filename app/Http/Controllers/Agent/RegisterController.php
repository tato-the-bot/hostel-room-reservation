<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Agent;
use Illuminate\Support\Facades\Hash;
use App\Mail\RegistrationOtp;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    /**
     * This method handles the register request.
     */
    public function register(Request $request)
    {
        // If user already logged in as any account, redirect them back to home page.
        if (Auth::guard('web_student')->user() || Auth::guard('web_agent')->user() || Auth::guard('web_admin')->user() ) {
            return redirect()->route('home');
        }

        // If this is a post request, try to login the user.
        if ($request->isMethod('POST')) {

            // This configures a validator to validate the request.
            $validator = Validator::make(
                $request->all(),
                [
                    'name' => ['required'],
                    'email' => ['required', 'unique:App\Models\Agent,email'],
                    'phone_number' => ['required'],
                    'password' => ['required', 'confirmed'],
                ]
            );

            // // If validation fails, do something.
            if (!$validator->fails()) {
                // Create new agent in database.
                $agent = new Agent;
                $agent->name = $request->post('name');
                $agent->email = $request->post('email');
                $agent->phone_number = $request->post('phone_number');
                $agent->password = Hash::make(strtolower($request->post('password')));
                $agent->otp_code = sprintf("%06d", mt_rand(1, 999999)); 
                $agent->save();

                // Store agent ID into this session so that when user key in OTP, it will know 
                // which agent to verify with.
                $request->session()->put('otp_verify_agent', $agent->id);

                // Prepare and send OTP email to the user.
                $registrationOtpEmail = new RegistrationOtp;
                $registrationOtpEmail->name = $agent->name;
                $registrationOtpEmail->otpCode = $agent->otp_code;
                Mail::to($agent->email)->send($registrationOtpEmail);

                // Redirect to OTP Page
                return redirect()->route('agent.register.otp'); 
            }
        }

        // Preserve the form field input so that user do not need to retype everything
        // when the validation has failed.
        // This also passes some error messages to be displayed to the user.
        $viewData = [
            'name' => $request->post('name'),
            'email' => $request->post('email'),
            'phone_number' => $request->post('phone_number'),
            'errors' => !empty($validator) ? $validator->errors()->getMessages() : [],
        ];

        // Render the agent register page.
        return view('agent.register', $viewData);
    }

    public function registerOtp(Request $request)
    {
        // Find out if there is a agent account to be verified in this session.
        $agentID = $request->session()->get('otp_verify_agent');

        // Find the agent that is to be verified.
        $agent = Agent::where('status', Agent::STATUS_UNVERIFIED)
            ->where('id', $agentID)
            ->first();

        // If there is no agent account to be verified, redirect back to home.
        if (empty($agent)) {
            return redirect()->route('home'); 
        }

        $errors = [];

        // If this is a post request, try to verify it.
        if ($request->isMethod('POST')) {
            // This configures a validator to validate the request.
            $validator = Validator::make(
                $request->all(),
                [
                    'otp' => ['required'],
                ]
            );

            // If otp matched, then set agent as active and remove otp_verify_agent key 
            // from the session.
            if ($agent->otp_code == $request->post('otp')) {
                $agent->status = Agent::STATUS_ACTIVE;
                $agent->save();

                $request->session()->forget('otp_verify_agent');
                
                return redirect()->route('home'); 
            } else {
                $errors[] = ['The provided OTP code do not match our records.'];
            }
        }

        // Preserve the form field input so that user do not need to retype everything
        // when the validation has failed.
        // This also passes some error messages to be displayed to the user.
        $viewData = [
            'errors' => $errors,
        ];

        return view('otp', $viewData);
    }
}
