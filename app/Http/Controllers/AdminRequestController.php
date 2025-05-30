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
        if(Auth::User()->isTeacher())
        {
            return redirect('/teacher/dashboard');
        }
        $pendingReqs = DocumentRequest::where('status', 'pending')->paginate(5, ['*'], 'pending_page');
        $acceptedReqs = DocumentRequest::where('status', 'accepted')->paginate(5, ['*'], 'accepted_page');
        $declinedReqs = DocumentRequest::where('status', 'declined')->paginate(5, ['*'], 'declined_page');

        return view('admin.request',[
            'pendingReqs' => $pendingReqs,
            'acceptedReqs' => $acceptedReqs,
            'declinedReqs' => $declinedReqs,
        ]);
    }

    public function approve($id)
    {
        $request = DocumentRequest::find($id);
        if (!$request) {
            return redirect()->back()->with('error', 'Request not found.');
        }
        $request->status = 'accepted';
        $request->save();

        return redirect()->back()->with('success', 'Request approved successfully.');
    }

    public function decline($id)
    {
        $request = DocumentRequest::find($id);
        if (!$request) {
            return redirect()->back()->with('error', 'Request not found.');
        }
        $request->status = 'declined';
        $request->save();

        return redirect()->back()->with('success', 'Request declined successfully.');
    }

    public function submitDocumentRequest(Request $request, $student)
    {
        $validated = $request->validate([
            'documentType' => 'required|string|max:255',
            'documentFormat' => 'required|string|max:255',
            'copies' => 'required|integer|min:1',
            'submitDate' => 'required|date',
        ]);

        try {
            $docRequest = new DocumentRequest();
            $docRequest->student_id = $student;
            $docRequest->document = $validated['documentType'] . ' (' . $validated['documentFormat'] . ') - Copies: ' . $validated['copies'];
            $docRequest->status = 'pending';
            $docRequest->date_needed = $validated['submitDate'];
            $docRequest->save();

            return response()->json(['status' => 'success', 'message' => 'Document request submitted successfully.']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Failed to submit document request: ' . $e->getMessage()]);
        }
    }
}
