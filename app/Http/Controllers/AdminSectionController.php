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
        // Get all sections with their current adviser loaded
        $sections = Section::with('adviserUser')->get();

        // Get all users with acc_type 'teacher'
        $teachers = User::where('acc_type', 'teacher')->get();

        return view('admin.section-teacher-assignment', compact('sections', 'teachers'));
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
