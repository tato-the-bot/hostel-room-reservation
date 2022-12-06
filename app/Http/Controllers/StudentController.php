<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;
use Illuminate\Support\Facades\Validator;

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
}
