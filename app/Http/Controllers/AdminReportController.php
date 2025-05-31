<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class AdminReportController extends Controller
{
    public function index()
    {
        $Studentcount = Student::count();
        $studentCount = Student::whereNotIn('enrollment_status', ['Graduated', 'Failed', 'Dropped Out'])->count();
        return view('admin.report', compact('Studentcount', 'studentCount'));
    }
}
