<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\Models\Student;
use App\Models\DocumentRequest;

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

        // Fetch requested documents for the student
        $requestedDocuments = DocumentRequest::where('student_id', $linking_id)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Dummy data for expenses
        $recentExpenses = [
            ['title' => 'Books Purchase', 'amount' => 1500.00, 'date' => '2023-06-01'],
            ['title' => 'Lab Fee', 'amount' => 2000.00, 'date' => '2023-05-28'],
            ['title' => 'Sports Fee', 'amount' => 500.00, 'date' => '2023-05-20'],
        ];

        // Dummy data for activities
        $recentActivities = [
            ['activity' => 'Joined Coding Club', 'date' => '2023-05-15'],
            ['activity' => 'Attended Seminar on AI', 'date' => '2023-05-10'],
            ['activity' => 'Volunteered for Community Service', 'date' => '2023-05-05'],
        ];

        // Share variables globally for the header layout
        View::share('requestedDocuments', $requestedDocuments);
        View::share('recentExpenses', $recentExpenses);
        View::share('recentActivities', $recentActivities);

        return view('student.dashboard', [
            'student'=> $student,
            'latestAcademicRecord' => $latestAcademicRecord,
            'courses' => $courses,
            'attendancePercentages' => $attendancePercentages,
            'absencePercentages' => $absencePercentages,
            'absenceDates' => $absenceDates,
            'latePercentages' => $latePercentages,
            'lateDates' => $lateDates,
            'lateTimes' => $lateTimes,
        ]);
    }
}
