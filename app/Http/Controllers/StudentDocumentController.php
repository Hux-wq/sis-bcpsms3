<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\ReqDocument;

class StudentDocumentController extends Controller
{
    public function index()
    {
        

        return view('student.document');
    }
}
