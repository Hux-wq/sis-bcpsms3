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
        // Paginate sections with their current adviser loaded
        $perPage = request()->input('per_page', 10);
        $sections = Section::with('adviserUser')->paginate($perPage);

        // Get all users with acc_type 'teacher'
        $teachers = User::where('acc_type', 'teacher')->get();

        // Calculate total sections, assigned and unassigned counts
        $totalSections = Section::count();
        $assignedCount = Section::whereNotNull('adviser')->count();
        $unassignedCount = Section::whereNull('adviser')->count();

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
