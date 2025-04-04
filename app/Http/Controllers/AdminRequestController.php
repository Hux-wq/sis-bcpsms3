<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DocumentRequest;
use Illuminate\Support\Facades\Auth;

class AdminRequestController extends Controller
{
    public function index()
    {
        if(Auth::User()->isStudent())
        {
            return redirect('/s/request');
        }
        $reqs = DocumentRequest::all();

        return view('admin.request',[
            'reqs' => $reqs
        ]);
    }
}
