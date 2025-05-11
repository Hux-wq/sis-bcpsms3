<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use OpenSpout\Writer\XLSX\Writer;
use OpenSpout\Common\Entity\Row;
use Rap2hpoutre\FastExcel\FastExcel;
use Carbon\Carbon;
use App\Models\Student;
use App\Models\AcademicRecord;

class DataExportController extends Controller
{
    public function exportStudents()
    {
        $directory = storage_path('app/exports');
        if (!file_exists($directory)) {
            mkdir($directory, 0755, true);
        }
        $timestamp = Carbon::now()->format('Ymd_His');
        $filePath = storage_path("app/exports/students_{$timestamp}.xlsx");
        $writer = new Writer();

        $writer->openToFile($filePath);

        $writer->addRow(Row::fromValues(['id','name','email','age','gender','birthdate','address']));

        Student::cursor()->each(function ($user) use ($writer){
            $writer->addRow(Row::fromValues([
                $user->student_number,
                $user->last_name .' '. $user->suffix_name.', '. $user->first_name.' '. $user->middle_name,
                $user->email_address,
                $user->age,
                $user->gender,
                $user->birthdate,
                $user->current_address,
            ]));
        });

        $writer->close();

        return response()->download($filePath);

    }

    public function exportFilteredStudents(Request $request)
    {   
        $year = $request->input('year');
        $status = $request->input('status');
        $semester = $request->input('semester');
        // $section = $request->input('section');
        
        // $students = Student::where('enrollment_status', $status)->whereHas('academicRecords', function ($query) use ($year, $semester) {
        //     // $query->where('enrollent_status', 'Enrolled');
        //    $query->where('school_year', $year);
        //     $query->where('semester', $semester);
        // })->get();
        $students = Student::join('academic_records', 'students.id', '=', 'academic_records.student_id')
    ->where('students.enrollment_status', $status)
    ->where('academic_records.school_year', $year)
    ->where('academic_records.semester', $semester)
    ->select('students.*') // To avoid selecting academic_records.* unless needed
    ->get();
            
        $directory = storage_path('app/exports');

        if (!file_exists($directory)) {
            mkdir($directory, 0755, true);
        }
        $timestamp = Carbon::now()->format('Ymd_His');
        $filePath = storage_path("app/exports/students_{$timestamp}.xlsx");
        $writer = new Writer();

        $writer->openToFile($filePath);

        $writer->addRow(Row::fromValues(['id','name','email','age','birthdate','address','semester','College Level','School Year', 'GPA']));

        foreach ($students as $student) {
            foreach ($student->academicRecords->where('semester', $semester)->where('school_year', $year) as $record) {
                $writer->addRow(Row::fromValues([
                    $student->student_number,
                    $student->last_name .' '. $student->suffix_name . ', ' . $student->first_name . ' ' . $student->middle_name,
                    $student->email_address,
                    $student->age,
                    $student->birthdate,
                    $student->current_address,
                    $record->semester ?? 'N/A',
                    $record->year_level ?? 'N/A',
                    $record->school_year ?? 'N/A',
                    $record->cumulative_gpa ?? 'N/A',
                ]));
            }
        }

        $writer->close();
        return response()->download($filePath);

    }
}
