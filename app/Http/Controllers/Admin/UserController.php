<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Agent;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $students = Student::all();
        $agents = Agent::all();

        $viewData = [
            'students' => $students,
            'agents' => $agents
        ];

        return view('admin.user-index', $viewData);
    }

    public function activateAgent(Request $request, $agentId)
    {   
        $agent = Agent::find($agentId);
        
        if ($agent) {
            $agent->status = Agent::STATUS_ACTIVE;
            $agent->save();
        }

        return redirect()->route('admin.users-index');
    }

    public function deactivateAgent(Request $request, $agentId)
    {
        $agent = Agent::find($agentId);
        
        if ($agent) {
            $agent->status = Agent::STATUS_FREEZE;
            $agent->save();
        }

        return redirect()->route('admin.users-index');
    }

    public function activateStudent(Request $request, $studentId)
    {
        $student = Student::find($studentId);
        
        if ($student) {
            $student->status = Student::STATUS_ACTIVE;
            $student->save();
        }

        return redirect()->route('admin.users-index');
    }

    public function deactivateStudent(Request $request, $studentId)
    {
        $student = Student::find($studentId);
        
        if ($student) {
            $student->status = Student::STATUS_FREEZE;
            $student->save();
        }

        return redirect()->route('admin.users-index');
    }

    public function viewStudent(Request $request, $studentId)
    {   
        $student = Student::find($studentId);
        
        return view('admin.view-student', [
            'student' => $student,
        ]);

    }

    public function viewAgent(Request $request, $agentId)
    {   
        $agent = Agent::find($agentId);

        return view('admin.view-agent', [
            'agent' => $agent,
        ]);
       
    }
}
