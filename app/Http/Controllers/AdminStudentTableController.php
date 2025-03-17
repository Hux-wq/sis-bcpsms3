<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminStudentTableController extends Controller
{
    public function index()
    {

        $users = User::select('id','email')->where('account_type','student')->with(['UserBasicInfo', 'UserNameInfo'])->get();
        

        return view('admin.student', compact('users'));
    }



    public function studentProfile($id)
    {

        $user = User::with(['UserBasicInfo', 'UserNameInfo', 'UserContactInfo'])
            ->findOrFail($id);
    
        return view('admin.student-profile', compact('user'));
    }
}
