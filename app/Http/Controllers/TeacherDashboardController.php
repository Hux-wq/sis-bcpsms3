<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Section;
use App\Models\Student;

class TeacherDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Assuming the teacher is linked to sections they teach with students eager loaded
        $sections = Section::where('adviser', $user->id)
            ->with(['students' => function ($query) {
                $query->orderBy('last_name', 'asc')->orderBy('first_name', 'asc');
            }])
            ->get();

        // Count of sections and students
        $sectionsCount = $sections->count();
        $studentsCount = $sections->sum(function ($section) {
            return $section->students->count();
        });

        return view('Teacher.dashboard', [
            'sections' => $sections,
            'sectionsCount' => $sectionsCount,
            'studentsCount' => $studentsCount,
        ]);
    }

    public function inputGrades()
    {
        $user = Auth::user();

        // Get sections where the teacher is adviser with students eager loaded
        $sections = Section::where('adviser', $user->id)
            ->with(['students' => function ($query) {
                $query->orderBy('last_name', 'asc')->orderBy('first_name', 'asc');
            }])
            ->get();

        return view('teacher.input-grades', [
            'sections' => $sections,
        ]);
    }

    public function storeGrades(Request $request)
    {
        // TODO: Implement storing grades logic
        return redirect()->route('teacher.grades.input')->with('success', 'Grade submitted successfully.');
    }

    public function inputAttendance()
    {
        $user = Auth::user();

        // Get sections where the teacher is adviser with students eager loaded
        $sections = Section::where('adviser', $user->id)
            ->with(['students' => function ($query) {
                $query->orderBy('last_name', 'asc')->orderBy('first_name', 'asc');
            }])
            ->get();

        return view('teacher.input-attendance', [
            'sections' => $sections,
        ]);
    }

    public function storeAttendance(Request $request)
    {
        // TODO: Implement storing attendance logic
        return redirect()->route('teacher.attendance.input')->with('success', 'Attendance submitted successfully.');
    }
}
