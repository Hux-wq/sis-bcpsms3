<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\AcademicRecord;

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
        $acad_records = AcademicRecord::where('student_id', $id)->get();
    
        return view('admin.student-profile', compact('student','acad_records'));
    }
}
