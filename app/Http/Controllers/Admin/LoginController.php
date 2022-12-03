<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Admin;

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
}