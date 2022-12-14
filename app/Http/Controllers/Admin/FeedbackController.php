<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Room;
use App\Models\Feedback;

class FeedbackController extends Controller
{
    public function index(Request $request)
    {
        // Query to get all feedbacks
        $feedbacks = Feedback::all();

        return view('admin.feedback-index', [
            'feedbacks' => $feedbacks
        ]);
    }

}
