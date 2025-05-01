<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\ReqDocument;

class StudentDocumentController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $files = \App\Models\UploadFiles::where('student_id', $user->linking_id)->orderBy('created_at', 'desc')->get();

        return view('student.document', compact('files'));
    }
}
