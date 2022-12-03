<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Admin;
use App\Mail\PasswordResetOtp;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /**
     * This method handles the login request.
     */
    public function login(Request $request)
    {
        // If user already logged in as any account, redirect them back to home page.
        if (Auth::guard('web_student')->user() || Auth::guard('web_agent')->user() || Auth::guard('web_admin')->user() ) {
            return redirect()->route('home');
        }

        $errors = [];

        // If this is a post request, try to login the user.
        if ($request->isMethod('POST')) {

            // This configures a validator to validate the login request.
            // Both email and password are required fields.
            // Email must be of valid email format.
            $validator = Validator::make(
                $request->all(),
                [
                    'email' => ['required', 'email'],
                    'password' => ['required'],
                ]
            );

            // If validation fails, do something.
            if (!$validator->fails()) {
                // Retrieve the email and password from the post request.
                $credentials = $request->only('email', 'password');

                // Filter only user with status Active.
                $credentials['status'] = Admin::STATUS_ACTIVE;

                // Attempt to login user using the admins table.
                if (Auth::guard('web_admin')->attempt($credentials)) {
                    // If success regenerate the session.
                    $request->session()->regenerate();
                    
                    // Redirect user to home. Process ends here.
                    return redirect()->route('home');
                }

                $errors[] = ['The provided credentials do not match our records.'];
            }
        }

        // Merge all error messages so that we can display all at once.
        // We have error message from validation and from the authentication.
        if (!empty($validator)) {
            $errors = array_merge($errors, $validator->errors()->getMessages());
        }

        // Preserve the form field input so that user do not need to retype everything
        // when the validation has failed.
        // This also passes some error messages to be displayed to the user.
        $viewData = [
            'email' => $request->post('email'),
            'errors' => $errors,
        ];

        // Render the admin login page.
        return view('admin.login', $viewData);
    }
    
    /**
     * This method handles the logout request.
     */
    public function logout(Request $request)
    {
        // Tells Laravel to logout the user.
        Auth::logout();
 
        // Stop tracking the session.
        $request->session()->invalidate();    
        $request->session()->regenerateToken();
    
        // Redirect user to home page.
        return redirect()->route('home');
    }

    /**
     * This method handles the forget password request.
     */
    public function forgetPassword(Request $request)
    {
        $errors = [];

        // If this is a post request, try to process forget password request
        if ($request->isMethod('POST')) {
            $admin = Admin::where('email', $request->email)->first();

            if ($admin) {
                // Set new OTP for reset password
                $admin->otp_code = sprintf("%06d", mt_rand(1, 999999));
                $admin->save();

                // Store admin ID into this session so that when user key in OTP, it will know 
                // which admin to verify with.
                $request->session()->put('otp_password_reset_admin', $admin->id);

                // Prepare and send OTP email to the user.
                $passwordResetOtpEmail = new PasswordResetOtp;
                $passwordResetOtpEmail->name = $admin->name;
                $passwordResetOtpEmail->otpCode = $admin->otp_code;

                try {
                    Mail::to($admin->email)->send($passwordResetOtpEmail);
                } catch (\Exception $e) {
                    // Do nothing, if email is not valid, it will not be sent out.
                }

                // Redirect to OTP Page
                return redirect()->route('admin.login.reset-password-otp'); 
            } else {
                $errors[] = ['Email does not exists.'];
            }
        }

        // This passes some error messages to be displayed to the user.
        $viewData = [
            'errors' => $errors,
        ];

        // Render admin forget password page page.
        return view('forget-password', $viewData);
    }

    public function passwordResetOtp(Request $request)
    {
        // Find out if there is a admin account who previously requested password reset in this session.
        $adminID = $request->session()->get('otp_password_reset_admin');

        // Find the admin that is to be verified.
        $admin = Admin::where('id', $adminID)->first();

        // If there is no admin account, redirect back to home.
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

                $request->session()->forget('otp_password_reset_admin');
                $request->session()->put('password_reset_admin', $admin->id);

                return redirect()->route('admin.login.reset-password'); 
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

    public function passwordReset(Request $request)
    {
        // Find out if there is a admin account who previously requested password reset in this session.
        $adminID = $request->session()->get('password_reset_admin');

        // Find the admin that is to be verified.
        $admin = Admin::where('id', $adminID)->first();

        // If there is no admin account, redirect back to home.
        if (empty($admin)) {
            return redirect()->route('home'); 
        }

        // If this is a post request, try to verify it.
        if ($request->isMethod('POST')) {
            // This configures a validator to validate the request.
            $validator = Validator::make(
                $request->all(),
                [
                    'password' => ['required', 'confirmed'],
                ]
            );

            if (!$validator->fails()) {
                $admin->password = Hash::make(strtolower($request->post('password')));
                $admin->save();

                $request->session()->forget('password_reset_admin');
                return redirect()->route('home'); 
            }
        }

        $viewData = [
            'errors' => !empty($validator) ? $validator->errors()->getMessages() : [],
        ];

        return view('password-reset', $viewData);
    }
}
