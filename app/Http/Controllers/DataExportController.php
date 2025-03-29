<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use OpenSpout\Writer\XLSX\Writer;
use OpenSpout\Common\Entity\Row;
use Rap2hpoutre\FastExcel\FastExcel;
use Carbon\Carbon;
use App\Models\Student;

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

    public function exportFilteredStudents($year)
    {
        $directory = storage_path('app/exports');
        if (!file_exists($directory)) {
            mkdir($directory, 0755, true);
        }
        $timestamp = Carbon::now()->format('Ymd_His');
        $filePath = storage_path("app/exports/students_{$timestamp}.xlsx");
        $writer = new Writer();

        $writer->openToFile($filePath);

        $writer->addRow(Row::fromValues(['id','name','email','age','birthdate','address']));

        Student::where('academic_year', $year)->cursor()->each(function ($user) use ($writer){
            $writer->addRow(Row::fromValues([
                $user->student_number,
                $user->last_name .' '. $user->suffix_name.', '. $user->first_name.' '. $user->middle_name,
                $user->email_address,
                $user->age,
                $user->birthdate,
                $user->current_address,
            ]));
        });

        $writer->close();

        return response()->download($filePath);

    }
}
