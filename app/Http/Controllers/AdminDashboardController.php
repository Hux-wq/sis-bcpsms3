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

        $studentsCount = Student::where('enrollment_status', 'Enrolled')->count();
        $students = Student::with(['program', 'academicRecords.section'])->where('enrollment_status', 'Enrolled')->get(['id', 'student_number', 'program_id', 'first_name', 'middle_name', 'last_name', 'suffix_name', 'age', 'gender', 'birthdate', 'religion', 'place_of_birth', 'current_address', 'email_address', 'contact_number', 'enrollment_status', 'created_at', 'updated_at']); // Adjust fields as needed
        $coursesCount = Course::count();
        $courses = Course::get(['course_code', 'title', 'credits', 'description']);
        $programsCount = Program::count();
        $programs = Program::get(['code', 'name']);
        $sections = Section::count();
        $departmentsCount = Department::count();
        $departments = Department::get(['code', 'name',]);

        return view('admin.dashboard',[
            'student_enrolled_count' => $studentsCount,
            'students' => $students,
            'courses_count' => $coursesCount,
            'courses' => $courses,
            'programs_count' => $programsCount,
            'programs' => $programs,
            'sections_count' => $sections,
            'departments_count' => $departmentsCount,
            'departments' => $departments,
        ]);
    }
}
