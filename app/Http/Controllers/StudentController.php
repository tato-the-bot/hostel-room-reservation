<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\ImageUploadController;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $student = Student::where('id', Auth::guard('web_student')->user()->id)
            ->first();

        return view('profile-view', [
            'student' => $student
        ]);
    }

    public function update(Request $request)
    {

        if ($request->isMethod('POST')) {
            $validator = Validator::make(
                $request->all(),
                [   
                    'image' => ['nullable','image','mimes:jpeg,png,jpg,gif,svg','max:2048'],
                    'name' => ['required','string'],
                    'email' => ['required','email'],
                    'phone_number' => ['required', 'string'],
                ]
            );

            if (!$validator->fails()) {
                $student = Student:: where('id', Auth::guard('web_student')->user()->id)
                    ->first();

                if ($request->image != NULL){
                    $imageName = time().'.'.$request->image->extension();  
                    $request->image->move(public_path('storage/images'), $imageName);
                    $imgURL = '/storage/images/'.$imageName;
                } else if($student->image != NULL){
                    $imgURL = $student->image;
                }else{
                    $imgURL = NULL;
                }

                $student->name = $request->get('name');
                $student->email = $request->get('email');
                $student->phone_number = $request->get('phone_number');
                $student->image = $imgURL;

                $student->save();
                
                return redirect()->route('profile-view');
            }
        }

        $student = Student::where('id', Auth::guard('web_student')->user()->id)
            ->first();

        $viewData = [
            'student' => $student,
            'errors' => !empty($validator) ? $validator->errors()->getMessages() : []
        ];

        return view('profile-update', $viewData);
    }

    public function changePassword(Request $request)
    {
        $errors = [];
        $student = Student::where('id', Auth::guard('web_student')->user()->id)->first();

        if ($request->isMethod('POST')) {
            // This configures a validator to validate the request.
            $validator = Validator::make(
                $request->all(),
                [   
                    'password' => ['required', 'confirmed'],
                ]
            );

            if (!$validator->fails()) {
                $isValid = Auth::validate([
                    'password' => $request->post('old_password'),
                    'email' => Auth::user()->email,
                ]);

                if($isValid){
                    $student->password = Hash::make($request->post('password'));
                    $student->save();
    
                    $request->session()->forget('password_reset_student');
                    return redirect()->route('home'); 
                }else{
                    $errors[] = ['The provided credentials do not match our records.'];
                }
                
            }
        }

        $viewData = [
            'errors' => $errors,
            'validate' => !empty($validator) ? $validator->errors()->getMessages() : []
        ];

        return view('change-password', $viewData);
    }

    public function delete(Request $request)
    {
        $errors = [];
        $student = Student::where('id', Auth::guard('web_student')->user()->id)->first();

        if ($request->isMethod('POST')) {
            // This configures a validator to validate the request.
            $validator = Validator::make(
                $request->all(),
                [   
                    'password' => ['required'],
                ]
            );
            if (!$validator->fails()) {
                $isValid = Auth::validate([
                    'password' => $request->post('password'),
                    'email' => Auth::user()->email,
                ]);

                if($isValid){
                    $student->status = Student::STATUS_FREEZE;
                    $student->save();
    
                    Auth::logout();
 
                    // Stop tracking the session.
                    $request->session()->invalidate();    
                    $request->session()->regenerateToken();
                    return redirect()->route('home'); 
                }else{
                    $errors[] = ['The provided credentials do not match our records.'];
                }
                
            }
        }

        $viewData = [
            'errors' => $errors,
            'validate' => !empty($validator) ? $validator->errors()->getMessages() : []
        ];

        return view('delete', $viewData);
    }
}
