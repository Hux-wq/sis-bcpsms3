<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\DocumentRequest;

class StudentRequestController extends Controller
{
    public function index()
    {
        return view('student.request');
    }






    public function store(Request $request)
{
    $validated = $request->validate([
        'document' => 'required|string',
    ]);

    try {
        DocumentRequest::create([
            'document' => $request->input('document'),
            'student_id' => Auth::user()->linking_id,
            'status' => 'pending',
        ]);

        // Return success response as JSON
        return response()->json([
            'status' => 'success',
            'message' => 'Document request submitted successfully!'
        ]);
    } catch (\Exception $e) {
        // Return error response as JSON
        return response()->json([
            'status' => 'error',
            'message' => 'Failed to submit document request. Please try again.'
        ]);
    }
}
}
