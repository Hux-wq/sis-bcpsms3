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

        $studentsCount = Student::whereIn('enrollment_status', ['Enrolled', 'Transferee', 'Returnee', 'Octoberian'])->count();
        $students = Student::with(['program', 'academicRecords.section'])->whereIn('enrollment_status', ['Enrolled', 'Transferee', 'Returnee', 'Octoberian'])->get(['id', 'student_number', 'program_id', 'first_name', 'middle_name', 'last_name', 'suffix_name', 'age', 'gender', 'birthdate', 'religion', 'place_of_birth', 'current_address', 'email_address', 'contact_number', 'enrollment_status', 'created_at', 'updated_at']);
        $coursesCount = Course::count();
        $courses = Course::get(['course_code', 'title', 'credits', 'description']);
        $programsCount = Program::count();
        $programs = Program::get(['code', 'name']);
        $sections = Section::count();
        $departmentsCount = Department::count();
        $departments = Department::get(['code', 'name',]);

        // Fetch recent uploaded documents (limit 5)
        $recentUploads = \App\Models\UploadFiles::with('user')->orderBy('created_at', 'desc')->limit(5)->get();

        // Fetch recent enrolled students (limit 5)
        $recentEnrolledStudents = Student::with('program')->where('enrollment_status', 'Enrolled',)->orderBy('created_at', 'desc')->limit(5)->get();

        // Get counts of Enrolled, Transferee, Returnee, Octoberian students for 2025
        $statusCounts2025 = Student::select('enrollment_status', \DB::raw('count(*) as count'))
            ->whereYear('created_at', 2025)
            ->whereIn('enrollment_status', ['Enrolled', 'Transferee', 'Returnee', 'Octoberian'])
            ->groupBy('enrollment_status')
            ->pluck('count', 'enrollment_status')
            ->toArray();

        // Dummy data for 2018-2024 for each status
        $dummyStatusData = [
            'Enrolled' => [
                '2018' => 10,
                '2019' => 15,
                '2020' => 20,
                '2021' => 25,
                '2022' => 30,
                '2023' => 35,
                '2024' => 40,
            ],
            'Transferee' => [
                '2018' => 3,
                '2019' => 4,
                '2020' => 5,
                '2021' => 6,
                '2022' => 7,
                '2023' => 8,
                '2024' => 9,
            ],
            'Returnee' => [
                '2018' => 2,
                '2019' => 2,
                '2020' => 3,
                '2021' => 3,
                '2022' => 4,
                '2023' => 4,
                '2024' => 5,
            ],
            'Octoberian' => [
                '2018' => 1,
                '2019' => 1,
                '2020' => 1,
                '2021' => 2,
                '2022' => 2,
                '2023' => 3,
                '2024' => 3,
            ],
        ];

        // Add 2025 data from database or 0 if not present
        foreach (['Enrolled', 'Transferee', 'Returnee', 'Octoberian'] as $status) {
            $dummyStatusData[$status]['2025'] = $statusCounts2025[$status] ?? 0;
        }


        // Get counts of Graduated, Failed, Dropped Out students for 2025
        $statusCounts2025GFDO = Student::select('enrollment_status', \DB::raw('count(*) as count'))
            ->whereYear('created_at', 2025)
            ->whereIn('enrollment_status', ['Graduated', 'Failed', 'Dropped Out'])
            ->groupBy('enrollment_status')
            ->pluck('count', 'enrollment_status')
            ->toArray();

        // Prepare dummy data for 2018-2024 for Graduated, Failed, Dropped Out
        $dummyStatusDataGFDO = [
            'Graduated' => [
                '2018' => 5,
                '2019' => 8,
                '2020' => 12,
                '2021' => 15,
                '2022' => 20,
                '2023' => 25,
                '2024' => 30,
            ],
            'Failed' => [
                '2018' => 2,
                '2019' => 3,
                '2020' => 4,
                '2021' => 5,
                '2022' => 6,
                '2023' => 7,
                '2024' => 8,
            ],
            'Dropped Out' => [
                '2018' => 1,
                '2019' => 1,
                '2020' => 2,
                '2021' => 2,
                '2022' => 3,
                '2023' => 3,
                '2024' => 4,
            ],
        ];

        // Add 2025 data from database or 0 if not present
        foreach (['Graduated', 'Failed', 'Dropped Out'] as $status) {
            $dummyStatusDataGFDO[$status]['2025'] = $statusCounts2025GFDO[$status] ?? 0;
        }

        $studentsGFDO = Student::with(['program', 'academicRecords.section'])
            ->whereIn('enrollment_status', ['Graduated', 'Failed', 'Dropped Out'])
            ->get(['id', 'student_number', 'program_id', 'first_name', 'middle_name', 'last_name', 'suffix_name', 'age', 'gender', 'birthdate', 'religion', 'place_of_birth', 'current_address', 'email_address', 'contact_number', 'enrollment_status', 'created_at', 'updated_at']);

        return view('admin.dashboard',[
            'student_enrolled_count' => $studentsCount,
            'students' => $students,
            'studentsGFDO' => $studentsGFDO,
            'courses_count' => $coursesCount,
            'courses' => $courses,
            'programs_count' => $programsCount,
            'programs' => $programs,
            'sections_count' => $sections,
            'departments_count' => $departmentsCount,
            'departments' => $departments,
            'recentUploads' => $recentUploads,
            'recentEnrolledStudents' => $recentEnrolledStudents,
            'statusPerYear' => $dummyStatusData,
            'statusPerYearGFDO' => $dummyStatusDataGFDO,
        ]);
    }
}
