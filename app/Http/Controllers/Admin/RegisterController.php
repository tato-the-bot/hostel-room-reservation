<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Admin;
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
                    'email' => ['required', 'unique:App\Models\Admin,email'],
                    'phone_number' => ['required'],
                    'password' => ['required', 'confirmed'],
                ]
            );

            // // If validation fails, do something.
            if (!$validator->fails()) {
                // Create new admin in database.
                $admin = new Admin;
                $admin->name = $request->post('name');
                $admin->email = $request->post('email');
                $admin->phone_number = $request->post('phone_number');
                $admin->password = Hash::make(strtolower($request->post('password')));
                $admin->otp_code = sprintf("%06d", mt_rand(1, 999999)); 
                $admin->save();

                // Store admin ID into this session so that when user key in OTP, it will know 
                // which admin to verify with.
                $request->session()->put('otp_verify_admin', $admin->id);

                // Prepare and send OTP email to the user.
                $registrationOtpEmail = new RegistrationOtp;
                $registrationOtpEmail->name = $admin->name;
                $registrationOtpEmail->otpCode = $admin->otp_code;

                try {
                    Mail::to($admin->email)->send($registrationOtpEmail);
                } catch (\Exception $e) {
                    // Do nothing, if email is not valid, it will not be sent out.
                }

                // Redirect to OTP Page
                return redirect()->route('admin.register.otp'); 
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

        // Render the admin register page.
        return view('admin.register', $viewData);
    }

    public function registerOtp(Request $request)
    {
        // Find out if there is a admin account to be verified in this session.
        $adminID = $request->session()->get('otp_verify_admin');

        // Find the admin that is to be verified.
        $admin = Admin::where('status', admin::STATUS_UNVERIFIED)
            ->where('id', $adminID)
            ->first();

        // If there is no admin account to be verified, redirect back to home.
        if (empty($admin)) {
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

            // If otp matched, then set admin as active and remove otp_verify_admin key 
            // from the session.
            if ($admin->otp_code == $request->post('otp')) {
                $admin->status = Admin::STATUS_ACTIVE;
                $admin->save();

                $request->session()->forget('otp_verify_admin');
                
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
