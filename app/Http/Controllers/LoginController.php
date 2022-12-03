<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Student;
use App\Models\User;

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
}
