<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class AdminStudentTableController extends Controller
{
    public function index()
    {

        $students = Student::where('enrollment_status', 'enrolled')->get();
        

        return view('admin.student', compact('students'));
    }



    public function studentProfile($id)
    {

        $student = Student::findOrFail($id);
    
        return view('admin.student-profile', compact('student'));
    }
}
