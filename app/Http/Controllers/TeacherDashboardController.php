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

        // Assuming the teacher is linked to sections they teach
        $sections = Section::where('teacher_id', $user->id)->get();

        // Get students in these sections
        $students = Student::whereIn('section_id', $sections->pluck('id'))->get();

        // Count of sections and students
        $sectionsCount = $sections->count();
        $studentsCount = $students->count();

        return view('Teacher.dashboard', [
            'sections' => $sections,
            'students' => $students,
            'sectionsCount' => $sectionsCount,
            'studentsCount' => $studentsCount,
        ]);
    }
}
