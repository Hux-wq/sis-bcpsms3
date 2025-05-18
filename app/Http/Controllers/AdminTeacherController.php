<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Section;

class AdminTeacherController extends Controller
{
    public function index()
    {
        // Fetch users with acc_type 'teacher' or 'department_head'
        $teachers = User::whereIn('acc_type', ['teacher', 'department_head'])->get();

        // Return the admin teacher view with the teachers data
        return view('admin.teacher', compact('teachers'));
    }

    public function showProfile($id)
    {
        $teacher = User::findOrFail($id);
        $sections = Section::where('adviser', $id)->get();

        // Fetch academic records for the teacher's sections with related section data
        $academicRecords = \App\Models\AcademicRecord::with('section')
            ->whereIn('section_id', $sections->pluck('id'))
            ->get();

        return view('admin.teacher-profile', compact('teacher', 'sections', 'academicRecords'));
    }

    public function updateProfile(Request $request, $id)
    {
        $teacher = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'section_ids' => 'array',
            'section_ids.*' => 'exists:sections,id',
        ]);

        $teacher->name = $request->input('name');
        $teacher->email = $request->input('email');
        $teacher->save();

        // Update sections adviser
        Section::where('adviser', $id)->update(['adviser' => null]);
        if ($request->has('section_ids')) {
            Section::whereIn('id', $request->input('section_ids'))->update(['adviser' => $id]);
        }

        return redirect()->route('admin.teachers.index')->with('success', 'Teacher profile updated successfully.');
    }
}
