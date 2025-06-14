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

        // Prepare academicPerformance data structure from grades
        $academicPerformance = [];

        \Log::debug('Grades:', ['grades' => $grades->toArray()]);

        foreach ($grades as $grade) {
            $course = $grade->course;
            if ($course) {
                // Determine year level from course level (assuming level is numeric and corresponds to year)
                $year = (int) ($course->level / 100); // e.g., level 100 -> year 1, 200 -> year 2
                if ($year < 1 || $year > 4) {
                    $year = 1; // default to 1 if out of range
                }

                // Map grading_period to semester number
                $gradingPeriodMap = [
                    '1st Semester' => 1,
                    '2nd Semester' => 2,
                ];
                $semester = $gradingPeriodMap[$grade->grading_period] ?? 1;

                if (!isset($academicPerformance[$year])) {
                    $academicPerformance[$year] = [];
                }
                if (!isset($academicPerformance[$year][$semester])) {
                    $academicPerformance[$year][$semester] = collect();
                }

                // Clone course to avoid modifying original relation
                $courseWithGrade = clone $course;
                $courseWithGrade->grade = $grade->grade;

                $academicPerformance[$year][$semester]->push($courseWithGrade);
            }
        }

        // Debug dump academicPerformance
        \Log::debug('Academic Performance Data:', ['academicPerformance' => is_array($academicPerformance) ? $academicPerformance : $academicPerformance->toArray()]);
    
        // Fetch attendances for the student
        $attendances = \App\Models\Attendance::with('subject')->where('student_id', $id)
            ->orderBy('attendance_date', 'desc')
            ->get();

        $presentAttendances = $attendances->where('status', 'present');
        $absentAttendances = $attendances->where('status', 'absent');
        $lateAttendances = $attendances->where('status', 'late');

        $totalCount = $attendances->count();
        $totalPresent = $presentAttendances->count();
        $totalAbsent = $absentAttendances->count();
        $totalLate = $lateAttendances->count();

        $presentPercentage = $totalCount > 0 ? round(($totalPresent / $totalCount) * 100) : 0;
        $absentPercentage = $totalCount > 0 ? round(($totalAbsent / $totalCount) * 100) : 0;
        $latePercentage = $totalCount > 0 ? round(($totalLate / $totalCount) * 100) : 0;

        return view('admin.student-profile', compact('student','acad_records', 'courses', 'grades', 'academicPerformance',
            'presentAttendances', 'absentAttendances', 'lateAttendances',
            'presentPercentage', 'absentPercentage', 'latePercentage',
            'totalPresent', 'totalAbsent', 'totalLate', 'totalCount'));
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