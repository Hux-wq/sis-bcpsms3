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
}
