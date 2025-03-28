<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\Response;
use Carbon\Carbon;
use App\Models\Student;

class DataExportController extends Controller
{
    public function exportStudents()
    {
        // Fetch users
        $users = Student::all();

        // Create new Spreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set headers
        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'Name');
        $sheet->setCellValue('C1', 'Email');
        $sheet->setCellValue('D1', 'Gender');
        $sheet->setCellValue('E1', 'Birth Date');
        $sheet->setCellValue('F1', 'Street Address');

        // Style header row
        $sheet->getStyle('A1:D1')->getFont()->setBold(true);

        // Add data rows
        $row = 2;
        foreach ($users as $user) {
            $fullname = $user->last_name .' '. $user->suffix_name .', ' . $user->first_name .' '. $user->middle_name;
            $sheet->setCellValue('A' . $row, $user->student_number);
            $sheet->setCellValue('B' . $row, $fullname);
            $sheet->setCellValue('C' . $row, $user->email_address);
            $sheet->setCellValue('D' . $row, $user->gender);
            $sheet->setCellValue('E' . $row, $user->birthdate ? \Carbon\Carbon::parse($user->birthdate)->format('M d, Y') : '');
            $sheet->setCellValue('E' . $row, $user->current_address);
            $row++;
        }

        // Auto-size columns
        foreach (range('A', 'D') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        // Generate file
        $filename = 'students_export_' . now()->format('YmdHis') . '.xlsx';
        $filepath = storage_path('app/' . $filename);

        // Save file
        $writer = new Xlsx($spreadsheet);
        $writer->save($filepath);

        // Download response
        return Response::download($filepath, $filename)
            ->deleteFileAfterSend(true);
    }
}
