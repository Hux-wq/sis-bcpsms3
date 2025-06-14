<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\Models\Student;
use App\Models\DocumentRequest;
use App\Models\Attendance;

class StudentDashboardController extends Controller
{
    public function index()
    {

        $linking_id = Auth::User()->linking_id;
        $student = Student::with(['program', 'academicRecords.section', 'studentSchoolInfo'])->findOrFail($linking_id);

        $latestAcademicRecord = $student->academicRecords->sortByDesc('created_at')->first();

        $attendancePercentages = [];
        $absencePercentages = [];
        $absenceDates = [];
        $latePercentages = [];
        $lateDates = [];
        $lateTimes = [];

        // Prepare academic performance data
        $academicPerformance = [];

        $semesters = ['1st Semester', '2nd Semester'];
        $years = [1, 2, 3, 4];

        // Fetch all courses for the student's program once
        $allCourses = \App\Models\Course::where('program_id', $student->program_id)->get()->groupBy('level');

        // Fetch all grades for the student and program once
        $allGrades = \App\Models\Grade::where('student_id', $student->id)
            ->where('program_id', $student->program_id)
            ->get();

        foreach ($years as $year) {
            foreach ($semesters as $semester) {
                // Get all courses for the program (ignore year level)
                $courses = $allCourses->flatten();

                // Map courses with their matching grades for the current semester
                $coursesWithGrades = $courses->map(function ($course) use ($allGrades, $semester) {
                    $gradeRecord = $allGrades->first(function ($grade) use ($course, $semester) {
                        return $grade->course_id === $course->id && $grade->grading_period === $semester;
                    });

                    return (object)[
                        'course_code' => $course->course_code,
                        'title' => $course->title,
                        'grade' => $gradeRecord ? $gradeRecord->grade : null,
                        'remarks' => $gradeRecord ? $gradeRecord->remarks : 'Pending',
                    ];
                });

                $academicPerformance[$year][$semester] = $coursesWithGrades;
            }
        }

        // // Dummy data for attendance and other sections remain unchanged
        // foreach ($allCourses->flatten() as $index => $course) {
        //     $attendancePercentages[] = rand(85, 100);
        //     $absencePercentages[] = rand(0, 10);
        //     $absenceDates[] = ['2023-01-10', '2023-01-15'];
        //     $latePercentages[] = rand(0, 5);
        //     $lateDates[] = ['2023-01-12', '2023-01-18'];
        //     $lateTimes[] = ['08:05 AM', '08:10 AM'];
        // }

        $requestedDocuments = DocumentRequest::where('student_id', $linking_id)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $recentExpenses = [
            ['title' => 'Books Purchase', 'amount' => 1500.00, 'date' => '2023-06-01'],
            ['title' => 'Lab Fee', 'amount' => 2000.00, 'date' => '2023-05-28'],
            ['title' => 'Sports Fee', 'amount' => 500.00, 'date' => '2023-05-20'],
        ];

        $recentActivities = [
            ['activity' => 'Joined Coding Club', 'date' => '2023-05-15'],
            ['activity' => 'Attended Seminar on AI', 'date' => '2023-05-10'],
            ['activity' => 'Volunteered for Community Service', 'date' => '2023-05-05'],
        ];

        View::share('requestedDocuments', $requestedDocuments);
        View::share('recentExpenses', $recentExpenses);
        View::share('recentActivities', $recentActivities);

        // Fetch attendances for the student
        $attendances = \App\Models\Attendance::with('subject')->where('student_id', $student->id)
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

        return view('student.dashboard', [
            'student'=> $student,
            'latestAcademicRecord' => $latestAcademicRecord,
            'academicPerformance' => $academicPerformance,
            'presentPercentage' => $presentPercentage,
            'absentPercentage' => $absentPercentage,
            'latePercentage' => $latePercentage,
            'totalPresent' => $totalPresent,
            'totalAbsent' => $totalAbsent,
            'totalLate' => $totalLate,
            'totalDays' => $totalCount,
            'presentAttendances' => $presentAttendances,
            'absentAttendances' => $absentAttendances,
            'lateAttendances' => $lateAttendances,
        ]);
    }

    public function courses()
    {
        $linking_id = Auth::User()->linking_id;
        $student = Student::findOrFail($linking_id);

        $programId = $student->program_id;

        $courses = collect();

        if ($programId) {
            $courses = \App\Models\Course::where('program_id', $programId)
                ->limit(8)
                ->get();
        }

        return view('student.courses', [
            'student' => $student,
            'courses' => $courses,
        ]);
    }
}
