<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Section;
use App\Models\User;

class AdminSectionController extends Controller
{
    // Show the form to assign teachers to sections
    public function index()
    {
        $perPage = request()->input('per_page', 10);
        $search = request()->input('search');
        $adviserFilter = request()->input('adviser_filter');

        $query = Section::with('adviserUser');

        // Apply search filter
        if ($search) {
            $query->where('section', 'like', '%' . $search . '%');
        }

        // Apply adviser filter
        if ($adviserFilter === 'assigned') {
            $query->whereNotNull('adviser');
        } elseif ($adviserFilter === 'unassigned') {
            $query->whereNull('adviser');
        }

        $sections = $query->paginate($perPage)->appends(request()->except('page'));

        // Get all users with acc_type 'teacher'
        $teachers = User::where('acc_type', 'teacher')->get();

        // Calculate counts based on filtered query (without pagination)
        $totalSections = $query->count();
        $assignedCount = $query->whereNotNull('adviser')->count();
        $unassignedCount = $query->whereNull('adviser')->count();

        return view('admin.section-teacher-assignment', compact('sections', 'teachers', 'totalSections', 'assignedCount', 'unassignedCount'));
    }

    // Update the adviser for a section
    public function update(Request $request, $id)
    {
        $request->validate([
            'adviser' => 'nullable|exists:users,id',
        ]);

        $section = Section::findOrFail($id);

        // Check if the adviser user is a teacher
        if ($request->adviser) {
            $teacher = User::where('id', $request->adviser)->where('acc_type', 'teacher')->first();
            if (!$teacher) {
                return redirect()->back()->withErrors(['adviser' => 'Selected user is not a teacher.']);
            }
        }

        $section->adviser = $request->adviser;
        $section->save();

        return redirect()->route('admin.section-teacher-assignment.index')->with('success', 'Section adviser updated successfully.');
    }
}
