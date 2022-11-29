<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        if ($request->isMethod('POST')) {
            $credentials = $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required'],
            ]);

            $credentials['status'] = User::USER_STATUS_ACTIVE;

            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();

                $role = Auth::user()->role;

                switch ($role) {
                    case User::USER_STUDENT_ROLE:
                        return redirect()->route('home');
                        break;
                    case User::USER_AGENT_ROLE:
                        return redirect()->route('home');
                        break;
                    case User::USER_ADMIN_ROLE:
                        return redirect()->route('home');
                        break;
                }
            }

            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ]);
        }

        return view('login');
    }

    public function logout(Request $request)
    {
        Auth::logout();
 
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('/');
    }
}
