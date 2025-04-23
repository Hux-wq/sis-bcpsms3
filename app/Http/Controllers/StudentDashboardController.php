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
        $student = Student::with(['program', 'academicRecords.section'])->findOrFail($linking_id);

        $latestAcademicRecord = $student->academicRecords->sortByDesc('created_at')->first();

        $courses = \App\Models\Course::where('program_id', $student->program_id)->get();

        $attendancePercentages = [];
        $absencePercentages = [];
        $absenceDates = [];
        $latePercentages = [];
        $lateDates = [];
        $lateTimes = [];

        foreach ($courses as $index => $course) {
            $attendancePercentages[] = rand(85, 100);
            $absencePercentages[] = rand(0, 10);
            $absenceDates[] = ['2023-01-10', '2023-01-15']; // static example, can be randomized or expanded
            $latePercentages[] = rand(0, 5);
            $lateDates[] = ['2023-01-12', '2023-01-18']; // static example
            $lateTimes[] = ['08:05 AM', '08:10 AM']; // static example
        }

        return view('student.dashboard', [
            'student'=> $student,
            'latestAcademicRecord' => $latestAcademicRecord,
            'courses' => $courses,
            'attendancePercentages' => $attendancePercentages,
            'absencePercentages' => $absencePercentages,
            'absenceDates' => $absenceDates,
            'latePercentages' => $latePercentages,
            'lateDates' => $lateDates,
            'lateTimes' => $lateTimes
        ]);
    }
}

