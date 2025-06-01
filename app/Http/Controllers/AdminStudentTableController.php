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
        $students = Student::where('enrollment_status', 'Enrolled')->get();
        return view('admin.student', compact('students'));
    }

    public function studentProfile($id)
    {
        $student = Student::findOrFail($id);
        
        $acad_records = AcademicRecord::where('student_id', $id)->get();
       
        // Load all courses for the student's program
        $courses = \App\Models\Course::where('program_id', $student->program_id)->get();

        // Load grades for the student with course relationship
        $grades = \App\Models\Grade::with('course')
            ->where('student_id', $id)
            ->get()
            ->keyBy('course_id');

        // Prepare academicPerformance data structure with all courses in 1st year
        $academicPerformance = [];

        $year = 1; // Assign all courses to 1st year as per user request

        foreach ($courses as $course) {
            $semesterRaw = $course->semester ?? null;

            // Convert semester string to integer key if possible
            $semester = null;
            if (is_numeric($semesterRaw)) {
                $semester = (int)$semesterRaw;
            } else {
                // Map common string values to integers
                $semesterMap = [
                    '1st Semester' => 1,
                    '2nd Semester' => 2,
                    'First Semester' => 1,
                    'Second Semester' => 2,
                ];
                $semester = $semesterMap[$semesterRaw] ?? 1; // Default to 1 if unknown
            }

            if (!isset($academicPerformance[$year])) {
                $academicPerformance[$year] = [];
            }
            if (!isset($academicPerformance[$year][$semester])) {
                $academicPerformance[$year][$semester] = collect();
            }

            // Find grade for the course if exists
            $grade = $grades->has($course->id) ? $grades->get($course->id)->grade : null;

            // Clone course to avoid modifying original relation
            $courseWithGrade = clone $course;
            $courseWithGrade->grade = $grade;

            $academicPerformance[$year][$semester]->push($courseWithGrade);
        }
    
        return view('admin.student-profile', compact('student','acad_records', 'courses', 'grades', 'academicPerformance'));
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

    public function returnee()
    {
        $students = Student::where('enrollment_status', 'Returnee')->get();
        return view('admin.returnee', compact('students'));
    }

    public function transferee()
    {
        $students = Student::where('enrollment_status', 'Transferee')->get();
        return view('admin.transferee', compact('students'));

        
    }

    public function octoberian()
    {
        $students = Student::where('enrollment_status', 'Octoberian')->get();
        return view('admin.octoberian', compact('students'));
    }

    public function graduated()
    {
        $students = Student::where('enrollment_status', 'Graduated')->get();
        return view('admin.graduated', compact('students'));
    }

    public function droppedOut()
    {
        $students = Student::where('enrollment_status', 'Dropped Out')->get();
        return view('admin.dropped-out', compact('students'));
    }

    public function failed()
    {
        $students = Student::where('enrollment_status', 'Failed')->get();
        return view('admin.failed', compact('students'));
    }

}