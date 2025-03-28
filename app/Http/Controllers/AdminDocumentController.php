<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DocumentList;

class AdminDocumentController extends Controller
{
    public function index()
    {
        $req_documents = DocumentList::all();

        return view('admin.document',[
            'req_documents' => $req_documents
        ]);
    }
}
