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
            UploadFiles::create([
                'student_id' => Auth::User()->linking_id,
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
                'fileName' => $fileName
            ]);
            
        } catch (\Exception $e) {
            // Return error response
            return response()->json([
                'success' => false,
                'message' => 'Upload failed: ' . $e->getMessage()
            ]);
        }
    }
}
