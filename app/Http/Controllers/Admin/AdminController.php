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
        $admin = Admin::where('id', Auth::guard('web_admin')->user()->id)
            ->first();

        return view('admin.profile-view', [
            'admin' => $admin
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
                $admin = Admin:: where('id', Auth::guard('web_admin')->user()->id)
                    ->first();

                if ($request->image != NULL){
                    $imageName = time().'.'.$request->image->extension();  
                    $request->image->move(public_path('storage/images'), $imageName);
                    $imgURL = '/storage/images/'.$imageName;
                } else if($admin->image != NULL){
                    $imgURL = $admin->image;
                }else{
                    $imgURL = NULL;
                }

                $admin->name = $request->get('name');
                $admin->email = $request->get('email');
                $admin->phone_number = $request->get('phone_number');
                $admin->image = $imgURL;

                $admin->save();
                
                return redirect()->route('admin.profile-view');
            }
        }

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
                $isValid = Auth::validate([
                    'password' => $request->post('old_password'),
                    'email' => Auth::user()->email,
                ]);

                if($isValid){
                    $admin->password = Hash::make($request->post('password'));
                    $admin->save();
    
                    $request->session()->forget('password_reset_admin');
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

        return view('admin.change-password', $viewData);
    }
}
