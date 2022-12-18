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
        // Query to get all students
        $students = Student::all();
        // Query to get all agent
        $agents = Agent::all();

        $viewData = [
            'students' => $students,
            'agents' => $agents
        ];

        return view('admin.user-index', $viewData);
    }

    public function activateAgent(Request $request, $agentId)
    {   
        // Query to find specific agent by ID
        $agent = Agent::find($agentId);
        
        // Update agent status to active
        if ($agent) {
            $agent->status = Agent::STATUS_ACTIVE;
            $agent->save();
        }

        return redirect()->route('admin.users-index');
    }

    public function deactivateAgent(Request $request, $agentId)
    {
        // Query to find specific agent by ID
        $agent = Agent::find($agentId);
        
        // Update agent status to freeze
        if ($agent) {
            $agent->status = Agent::STATUS_FREEZE;
            $agent->save();
        }

        return redirect()->route('admin.users-index');
    }

    public function activateStudent(Request $request, $studentId)
    {
        // Query to find specific student by ID  
        $student = Student::find($studentId);
        
        // Update student status to active
        if ($student) {
            $student->status = Student::STATUS_ACTIVE;
            $student->save();
        }

        return redirect()->route('admin.users-index');
    }

    public function deactivateStudent(Request $request, $studentId)
    {
        // Query to find specific student by ID   
        $student = Student::find($studentId);
        
        // Update student status to freeze
        if ($student) {
            $student->status = Student::STATUS_FREEZE;
            $student->save();
        }

        return redirect()->route('admin.users-index');
    }

    public function viewStudent(Request $request, $studentId)
    {   
        // Query to find specific student by ID
        $student = Student::find($studentId);
        
        return view('admin.view-student', [
            'student' => $student,
        ]);

    }

    public function viewAgent(Request $request, $agentId)
    {   
        // Query to find specific agent by ID
        $agent = Agent::find($agentId);

        return view('admin.view-agent', [
            'agent' => $agent,
        ]);
       
    }
}
