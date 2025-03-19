<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class AdminPendingEnrolleesController extends Controller
{
    public function index()
    {
        $students = Student::where('enrollment_status','pending')->get();

    
        return view('admin.pending-enrollees',[
            
            'students' => $students
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
        'id' => 'required|exists:students,id',  
    ]);

    $student = Student::find($request->id);
        
        if ($student) {
            $student->enrollment_status = 'enrolled';

            $student->save();

            // return response()->json(['message' => 'Enrollment status updated to enrolled.'], 200);
            return back()->with('enrolled-success', 'Enrollment status updated to enrolled.');
            
        } else {
            return response()->json(['message' => 'Student not found.'], 404);
        }
    }
} 