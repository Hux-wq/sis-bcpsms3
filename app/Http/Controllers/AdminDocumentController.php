<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\DocumentList;
use App\Models\UploadFiles;

class AdminDocumentController extends Controller
{
    public function index()
    {
        if(Auth::User()->isStudent())
        {
            return redirect('/s/document');
        }
        $files = UploadFiles::all();

        return view('admin.document',[
            'files' => $files
        ]);
    }
}
