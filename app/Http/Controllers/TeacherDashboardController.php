<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Section;
use App\Models\Student;

class TeacherDashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $search = $request->input('search');

        // Assuming the teacher is linked to sections they teach with students eager loaded
        $sections = Section::where('adviser', $user->id)
            ->with(['students' => function ($query) use ($search) {
                if ($search) {
                    $query->where(function ($q) use ($search) {
                        $q->where('first_name', 'like', '%' . $search . '%')
                          ->orWhere('last_name', 'like', '%' . $search . '%')
                          ->orWhere('student_number', 'like', '%' . $search . '%');
                    });
                }
                $query->orderBy('last_name', 'asc')->orderBy('first_name', 'asc');
            }])
            ->get();

        // Count of sections and students
        $sectionsCount = $sections->count();
        $studentsCount = $sections->sum(function ($section) {
            return $section->students->count();
        });

        return view('teacher.dashboard', [
            'sections' => $sections,
            'sectionsCount' => $sectionsCount,
            'studentsCount' => $studentsCount,
            'search' => $search,
        ]);
    }

    public function searchStudents(Request $request)
    {
        $user = Auth::user();
        $search = $request->input('search');

        $sections = Section::where('adviser', $user->id)
            ->with(['students' => function ($query) use ($search) {
                if ($search) {
                    $query->where(function ($q) use ($search) {
                        $q->where('first_name', 'like', '%' . $search . '%')
                          ->orWhere('last_name', 'like', '%' . $search . '%')
                          ->orWhere('student_number', 'like', '%' . $search . '%');
                    });
                }
                $query->orderBy('last_name', 'asc')->orderBy('first_name', 'asc');
            }])
            ->get();

        // Format data for JSON response
        $data = $sections->map(function ($section) {
            return [
                'id' => $section->id,
                'section' => $section->section,
                'students' => $section->students->map(function ($student) {
                    return [
                        'id' => $student->id,
                        'student_number' => $student->student_number,
                        'first_name' => $student->first_name,
                        'last_name' => $student->last_name,
                        'program_name' => $student->program ? $student->program->name : 'N/A',
                    ];
                }),
            ];
        });

        return response()->json(['sections' => $data]);
    }

    public function inputGrades()
    {
        $user = Auth::user();

        // Get sections where the teacher is adviser with students and their program eager loaded
        $sections = Section::where('adviser', $user->id)
            ->with(['students' => function ($query) {
                $query->with('program')->orderBy('last_name', 'asc')->orderBy('first_name', 'asc');
            }])
            ->get();

        // Get unique program_ids from students in the sections
        $programIds = $sections->flatMap(function ($section) {
            return $section->students->pluck('program_id');
        })->unique()->filter();

        // Fetch courses grouped by program_id limited to 8 courses per program
        $coursesByProgram = [];
        foreach ($programIds as $programId) {
            $coursesByProgram[$programId] = \App\Models\Course::where('program_id', $programId)
                ->limit(8)
                ->get();
        }

        return view('teacher.input-grades', [
            'sections' => $sections,
            'coursesByProgram' => $coursesByProgram,
        ]);
    }

    public function storeGrades(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'subject' => 'required|string',
            'grade' => 'required',
            'semester' => 'required|string',
            'remarks' => 'nullable|string',
        ]);

        $student = \App\Models\Student::findOrFail($request->student_id);
        $programId = $student->program_id;

        // Find course by title and program_id
        $course = \App\Models\Course::where('title', $request->subject)
            ->where('program_id', $programId)
            ->first();

        if (!$course) {
            return redirect()->route('teacher.grades.input')->with('error', 'Selected subject not found for the student\'s program.');
        }

        // Convert grade to decimal if possible
        $gradeValue = is_numeric($request->grade) ? floatval($request->grade) : null;

        \App\Models\Grade::create([
            'student_id' => $student->id,
            'course_id' => $course->id,
            'program_id' => $programId,
            'grade' => $gradeValue,
            'remarks' => $request->remarks,
            'grading_period' => $request->semester,
        ]);

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
