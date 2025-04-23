<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\User;
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

        // Load a limited number of courses (3 to 8) for the student randomly
        $courses = \App\Models\Course::inRandomOrder()->limit(rand(3, 8))->get();
    
        return view('admin.student-profile', compact('student','acad_records', 'courses'));
    }

    public function studentCreateUserAccount(Request $request)
    {
        try {
            $validated = $request->validate([
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:8',
                'id' => 'required|integer',
            ]);

            $email = $request->input('email');
            $pass = $request->input('password');
            $id = $request->input('id');

            User::create([
                'name' => 'null',
                'email' => $email, 
                'password' => bcrypt($pass), 
                'linking_id' => $id,  
            ]);

            // Return a JSON response with success message
            return response()->json(['status' => 'success', 'message' => 'Account created successfully!']);

        } catch (\Exception $e) {
            \Log::error('Error creating user account: ' . $e->getMessage());

            // Return a JSON response with error message
            return response()->json(['status' => 'error', 'message' => 'An error occurred while creating the account. Please try again.']);
        }
    }



}
