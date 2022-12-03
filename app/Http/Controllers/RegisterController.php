<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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
                    'student_id' => ['required', 'unique:App\Models\Student,student_id'],
                    'email' => ['required', 'unique:App\Models\Student,email'],
                    'phone_number' => ['required'],
                    'password' => ['required', 'confirmed'],
                ]
            );

            // // If validation fails, do something.
            if (!$validator->fails()) {
                // Create new student in database.
                $student = new Student;
                $student->name = $request->post('name');
                $student->student_id = $request->post('student_id');
                $student->email = $request->post('email');
                $student->phone_number = $request->post('phone_number');
                $student->password = Hash::make($request->post('password'));
                $student->save();

                // Redirect back to home
                return redirect()->route('home'); 
            }
        }

        // Preserve the form field input so that user do not need to retype everything
        // when the validation has failed.
        $viewData = [
            'name' => $request->post('name'),
            'student_id' => $request->post('student_id'),
            'email' => $request->post('email'),
            'phone_number' => $request->post('phone_number'),
            'errors' => !empty($validator) ? $validator->errors() : [],
        ];

        // Render the student register page.
        return view('register', $viewData);
    }
}
