<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\ImageUploadController;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        // Query to get admin details
        $admin = Admin::where('id', Auth::guard('web_admin')->user()->id)
            ->first();

        // Return admin details
        return view('admin.profile-view', [
            'admin' => $admin
        ]);
    }

    public function update(Request $request)
    {
        // If HTTP method = POST
        if ($request->isMethod('POST')) {

             // This configures a validator to validate the request.
            $validator = Validator::make(
                $request->all(),
                [   
                    'image' => ['nullable','image','mimes:jpeg,png,jpg,gif,svg','max:2048'],
                    'name' => ['required','string'],
                    'email' => ['required','email'],
                    'phone_number' => ['required', 'string'],
                ]
            );
            // If validating input is not fail 
            if (!$validator->fails()) {
                // Get admin data
                $admin = Admin:: where('id', Auth::guard('web_admin')->user()->id)
                    ->first();
                // If input image is not NULL 
                if ($request->image != NULL){
                    // change image name to current upload time
                    $imageName = time().'.'.$request->image->extension();  
                    // save image to public path
                    $request->image->move(public_path('storage/images'), $imageName);
                    // store img path into a variable
                    $imgURL = '/storage/images/'.$imageName;
                // If in admin data originally has img 
                } else if($admin->image != NULL){
                    // Keep the img
                    $imgURL = $admin->image;
                }else{
                    // If input img is NULL then the URL would be NULL (No default img)
                    $imgURL = NULL;
                }

                $admin->name = $request->get('name');
                $admin->email = $request->get('email');
                $admin->phone_number = $request->get('phone_number');
                $admin->image = $imgURL;

                // Update admin profile
                $admin->save();
                
                return redirect()->route('admin.profile-view');
            }
        }

        // Query to get admin details 
        $admin = Admin::where('id', Auth::guard('web_admin')->user()->id)
            ->first();

        $viewData = [
            'admin' => $admin,
            'errors' => !empty($validator) ? $validator->errors()->getMessages() : []
        ];

        return view('admin.profile-update', $viewData);
    }

    public function changePassword(Request $request)
    {
        $errors = [];
        // Query to get admin details 
        $admin = Admin::where('id', Auth::guard('web_admin')->user()->id)->first();

        if ($request->isMethod('POST')) {
            // This configures a validator to validate the request.
            $validator = Validator::make(
                $request->all(),
                [   
                    'password' => ['required', 'confirmed'],
                ]
            );

            if (!$validator->fails()) {
                // Validate if input matches the database
                $isValid = Auth::validate([
                    'password' => $request->post('old_password'),
                    'email' => Auth::user()->email,
                ]);

                // If match, update database 
                if($isValid){
                    $admin->password = Hash::make($request->post('password'));
                    $admin->save();
    
                    $request->session()->forget('password_reset_admin');
                    return redirect()->route('home');
                // Else, display error 
                }else{
                    $errors[] = ['The provided credentials do not match our records.'];
                }
                
            }
        }

        $viewData = [
            'errors' => $errors,
            'validate' => !empty($validator) ? $validator->errors()->getMessages() : []
        ];

        return view('admin.change-password', $viewData);
    }
}
