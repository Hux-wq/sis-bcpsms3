<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Course;
use App\Models\Program;
use App\Models\Section;
use App\Models\Department;

class AdminDashboardController extends Controller
{
    public function index()
    {
        if(Auth::User()->isStudent())
        {
            return redirect('/s/dashboard');
        }

        $students = Student::where('enrollment_status', 'Enrolled')->count();
        $courses = Course::count();
        $programs = Program::count();
        $sections = Section::count();
        $departments = Department::count();

        return view('admin.dashboard',[
            'student_enrolled_count' => $students,
            'courses_count' => $courses,
            'programs_count' => $programs,
            'sections_count' => $sections,
            'departments_count' => $departments,
        ]);
    }
}
