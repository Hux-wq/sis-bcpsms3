<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;


class ApiController extends Controller
{
    public function students()
    {
        try {
            $students = User::where('account_type', 'student')
                ->select('id', 'account_number')
                ->with([
                    'userNameInfo' => function ($query) {
                        $query->select('user_id', 'first_name', 'middle_name', 'last_name', 'suffix_name'); 
                    },
                    'userBasicInfo' => function ($query) {
                        $query->select('user_id', 'age', 'gender', 'birthdate', 'religion', 'place_of_birth', 'current_address'); 
                    },
                    'userContactInfo' => function ($query) {
                        $query->select('user_id', 'phone_number', 'email_address', 'facebook'); 
                    },
                    'userSchoolInfo' => function ($query) {
                        $query->select('user_id', 'current_year_level', 'scholastic_type'); 
                    },
                ])
                ->get();

            return response()->json([
                'status' => 'success',
                'data' => $students
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
{
    // Validate the incoming request
    $validator = Validator::make($request->all(), [
        'first_name' => 'required|string|max:255',
        'middle_name' => 'nullable|string|max:255',
        'last_name' => 'required|string|max:255',
        'suffix_name' => 'nullable|string|max:255',
        'age' => 'required|integer|min:18',
        'gender' => 'required|in:male,female,other',
        'birthdate' => 'required|date',
        'religion' => 'required|string|max:255',
        'place_of_birth' => 'required|string|max:255',
        'current_address' => 'required|string',
        'email_address' => 'required|email|unique:students,email_address',
        'contact_number' => 'required|string|max:15',
        'enrollment_date' => 'required|date',
        'enrollment_for' => 'required|string|max:255',
        'desired_major' => 'required|string|max:255',
        'enrollment_status' => 'required|string|max:255',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status' => 'error',
            'message' => 'Validation failed',
            'errors' => $validator->errors(),
        ], 422);
    }

    try {
        // Create the student record using insertGetId
        $studentData = $validator->validated();

        $studentId = DB::table('students')->insertGetId($studentData);
        
        return response()->json([
            'status' => 'success',
            'message' => 'Student successfully created!',
            'data' => $studentData
        ], 201);

    } catch (\Exception $e) {
        
        return response()->json([
            'status' => 'error',
            'message' => 'An error occurred while creating the student record.',
            'error' => $e->getMessage()
        ], 500);
    }
}

}