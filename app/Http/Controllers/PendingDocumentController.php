<?php

namespace App\Http\Controllers;
use App\Models\ReqDocument;
use App\Models\Student;
use Illuminate\Http\Request;

class PendingDocumentController extends Controller
{
    public function index($id)
    {
        $students = Student::findorfail($id);
       $documents = ReqDocument::where('student_id', $id)->get();

        return view('admin.pending-document', [
               'students' =>     $students,
               'documents' =>     $documents
        ]);


    }
}
