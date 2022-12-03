<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Student;
use App\Models\User;
use App\Mail\PasswordResetOtp;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function selectLogin(Request $request)
    {
        return view('select-login');
    }

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
            // Both student ID and password are required fields.
            $validator = Validator::make(
                $request->all(),
                [
                    'student_id' => ['required'],
                    'password' => ['required'],
                ]
            );

            // If validation pass, try login.
            if (!$validator->fails()) {
                // Retrieve the student ID and password from the post request.
                $credentials = $request->only('student_id', 'password');

                // Filter only user with status Active.
                $credentials['status'] = Student::STATUS_ACTIVE;

                // Attempt to login user using the students table.
                if (Auth::guard('web_student')->attempt($credentials)) {
                    // If success regenerate the session.
                    Auth::guard('web_student')->getSession()->regenerate();
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
            'student_id' => $request->post('student_id'),
            'errors' => $errors,
        ];

        // Render the student login page.
        return view('login', $viewData);
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
            $student = Student::where('email', $request->email)->first();

            if ($student) {
                // Set new OTP for reset password
                $student->otp_code = sprintf("%06d", mt_rand(1, 999999));
                $student->save();

                // Store student ID into this session so that when user key in OTP, it will know 
                // which student to verify with.
                $request->session()->put('otp_password_reset_student', $student->id);

                // Prepare and send OTP email to the user.
                $passwordResetOtpEmail = new PasswordResetOtp;
                $passwordResetOtpEmail->name = $student->name;
                $passwordResetOtpEmail->otpCode = $student->otp_code;

                try {
                    Mail::to($student->email)->send($passwordResetOtpEmail);
                } catch (\Exception $e) {
                    // Do nothing, if email is not valid, it will not be sent out.
                }

                // Redirect to OTP Page
                return redirect()->route('student.login.reset-password-otp'); 
            } else {
                $errors[] = ['Email does not exists.'];
            }
        }

        // This passes some error messages to be displayed to the user.
        $viewData = [
            'errors' => $errors,
        ];

        // Render student forget password page page.
        return view('forget-password', $viewData);
    }

    public function passwordResetOtp(Request $request)
    {
        // Find out if there is a student account who previously requested password reset in this session.
        $studentID = $request->session()->get('otp_password_reset_student');

        // Find the student that is to be verified.
        $student = Student::where('id', $studentID)->first();

        // If there is no student account, redirect back to home.
        if (empty($student)) {
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

            // If otp matched, then set student as active and remove otp_verify_student key 
            // from the session.
            if ($student->otp_code == $request->post('otp')) {
                $student->status = Student::STATUS_ACTIVE;
                $student->save();

                $request->session()->forget('otp_password_reset_student');
                $request->session()->put('password_reset_student', $student->id);

                return redirect()->route('student.login.reset-password'); 
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
        // Find out if there is a student account who previously requested password reset in this session.
        $studentID = $request->session()->get('password_reset_student');

        // Find the student that is to be verified.
        $student = Student::where('id', $studentID)->first();

        // If there is no student account, redirect back to home.
        if (empty($student)) {
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
                $student->password = Hash::make(strtolower($request->post('password')));
                $student->save();

                $request->session()->forget('password_reset_student');
                return redirect()->route('home'); 
            }
        }

        $viewData = [
            'errors' => !empty($validator) ? $validator->errors()->getMessages() : [],
        ];

        return view('password-reset', $viewData);
    }
}
