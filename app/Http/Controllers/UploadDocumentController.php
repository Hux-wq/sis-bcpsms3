<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\UploadFiles;
class UploadDocumentController extends Controller
{
    public function store(Request $request)
    {
        try {
            $request->validate([
                'document' => 'required|mimes:pdf,docx|max:2048',
            ]);


            $file = $request->file('document');
            $originalName = $file->getClientOriginalName();
            $fileName = time() . '_' . $originalName;
            $filePath = $file->storeAs('documents/' . Auth::id(), $fileName, 'public');
            $fileSize = $file->getSize();
            $fileType = $file->getClientMimeType();

            // Save file details to database
            $user = Auth::user();
            $studentName = $user->first_name . ' ' . $user->middle_name . ' ' . $user->last_name . ' ' . $user->suffix_name;

            $fileModel = UploadFiles::create([
                'student_id' => $user->linking_id,
                'document_id'=> null,
                'file_name' => $originalName,
                'file_path' => $filePath,
                'file_type' => $fileType,
                'file_size' => $fileSize,
                'file_for' => null,
            ]);
            
            // Return success response
            return response()->json([
                'success' => true,
                'message' => 'Document uploaded successfully!',
                'fileName' => $fileName,
                'file' => [
                    'id' => $fileModel->id,
                    'file_name' => $fileModel->file_name,
                    'created_at' => $fileModel->created_at->toDateTimeString(),
                ],
            ]);
            
        } catch (\Exception $e) {
            // Return error response
            return response()->json([
                'success' => false,
                'message' => 'Upload failed: ' . $e->getMessage()
            ]);
        }
    }

    public function destroy($id)
    {
        $file = UploadFiles::find($id);
        if (!$file) {
            return redirect()->back()->with('error', 'File not found.');
        }

        try {
            // Delete the file from storage
            Storage::disk('public')->delete($file->file_path);

            // Delete the record from database
            $file->delete();

            return redirect()->back()->with('success', 'File deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete file: ' . $e->getMessage());
        }
    }
}
