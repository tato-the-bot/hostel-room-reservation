<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Student;
use App\Models\User;
use App\Mail\RegistrationOtp;
use Illuminate\Support\Facades\Hash;
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
                    'student_id' => ['required', 'unique:App\Models\Student,student_id', 'numeric', 'digits:7'],
                    'email' => ['required', 'unique:App\Models\Student,email'],
                    'phone_number' => ['required'],
                    'password' => ['required', 'confirmed'],
                ]
            );

            // // If validation fails, do something.
            if (!$validator->fails()) {
                // Create new student in database.
                // At the same time, generate new OTP code for this user.
                $student = new Student;
                $student->name = $request->post('name');
                $student->student_id = $request->post('student_id');
                $student->email = $request->post('email');
                $student->phone_number = $request->post('phone_number');
                $student->password = Hash::make(strtolower($request->post('password')));
                $student->otp_code = sprintf("%06d", mt_rand(1, 999999)); 
                $student->save();

                // Store student ID into this session so that when user key in OTP, it will know 
                // which student to verify with.
                $request->session()->put('otp_verify_student', $student->id);

                // Prepare and send OTP email to the user.
                $registrationOtpEmail = new RegistrationOtp;
                $registrationOtpEmail->name = $student->name;
                $registrationOtpEmail->otpCode = $student->otp_code;

                try {
                    Mail::to($student->email)->send($registrationOtpEmail);
                } catch (\Exception $e) {
                    // Do nothing, if email is not valid, it will not be sent out.
                }

                // Redirect to OTP Page
                return redirect()->route('student.register.otp'); 
            }
        }

        // Preserve the form field input so that user do not need to retype everything
        // when the validation has failed.
        // This also passes some error messages to be displayed to the user.
        $viewData = [
            'name' => $request->post('name'),
            'student_id' => $request->post('student_id'),
            'email' => $request->post('email'),
            'phone_number' => $request->post('phone_number'),
            'errors' => !empty($validator) ? $validator->errors()->getMessages() : [],
        ];

        // Render the student register page.
        return view('register', $viewData);
    }

    public function registerOtp(Request $request)
    {
        // Find out if there is a student account to be verified in this session.
        $studentID = $request->session()->get('otp_verify_student');

        // Find the student that is to be verified.
        $student = Student::where('status', Student::STATUS_UNVERIFIED)
            ->where('id', $studentID)
            ->first();

        // If there is no student account to be verified, redirect back to home.
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

                $request->session()->forget('otp_verify_student');
                
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
