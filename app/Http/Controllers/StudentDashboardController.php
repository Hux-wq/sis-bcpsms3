<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;

class StudentDashboardController extends Controller
{
    public function index()
    {

        $linking_id = Auth::User()->linking_id;
        $student = Student::findorfail($linking_id);
        
        return view('student.dashboard', [
            'student'=> $student
        ]);
    }
}

