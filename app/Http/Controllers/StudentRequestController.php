<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\DocumentRequest;

class StudentRequestController extends Controller
{
    public function index()
    {
        $userId = Auth::user()->linking_id;
        $reqs = DocumentRequest::where('student_id', $userId)->paginate(5);

        // Fetch related file paths for accepted requests
        $filePaths = [];
        foreach ($reqs as $req) {
            if ($req->status === 'accepted') {
                $file = \App\Models\UploadFiles::where('student_id', $userId)
                    ->where('file_for', $req->document)
                    ->first();
                $filePaths[$req->id] = $file ? $file->file_path : null;
            }
        }

        return view('student.request', compact('reqs', 'filePaths'));
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
