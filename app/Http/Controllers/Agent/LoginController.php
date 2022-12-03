<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Agent;

class LoginController extends Controller
{
    /**
     * This method handles the login request.
     */
    public function login(Request $request)
    {
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
            if ($validator->fails()) {
                // Return to the login page with the error information.
                return back()->withErrors($validator->errors());
            }

            // Retrieve the email and password from the post request.
            $credentials = $request->only('email', 'password');

            // Filter only user with status Active.
            $credentials['status'] = Agent::STATUS_ACTIVE;

            // Attempt to login user using the agents table.
            if (Auth::guard('web_agent')->attempt($credentials)) {
                // If success regenerate the session.
                $request->session()->regenerate();
                
                // Redirect user to home. Process ends here.
                return redirect()->route('home');
            }

            // If login failed, return with the error.
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ]);
        }

        // Render the agent login page.
        return view('agent.login');
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
