<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;


class ApiController extends Controller
{
    public function students()
    {
        try {
            $students = Student::all();

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

    public function alumni()
    {
        try {
            $alumni = Student::where('enrollment_status', 'Graduated')->get();

            return response()->json([
                'status' => 'success',
                'data' => $alumni
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
        $validator = Validator::make($request->all(), [
            'student_number' => 'required|integer',
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'sex' => 'required|in:male,female,other',
            'birthdate' => 'required|date',
            'email' => 'required|email|unique:students,email_address',
            'address' => 'required|string',
            'contact_number' => 'required|string|max:15',
            'status' => 'required|string|max:255',
            'academic_year' => 'required|string|max:255',
            'department_code' => 'required|string|max:255',
            'year_level' => 'required|integer|min:1',
            'guardian_name' => 'required|string|max:255',
            'guardian_contact' => 'required|string|max:15',
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }
        
        try {
            // Map validated data to individual variables
            $studentNumber = $validator->validated()['student_number'];
            $firstName = $validator->validated()['first_name'];
            $middleName = $validator->validated()['middle_name'] ?? null;  // Null if not provided
            $lastName = $validator->validated()['last_name'];
            $gender = $validator->validated()['sex'];
            $birthdate = $validator->validated()['birthdate'];
            $age = Carbon::parse($birthdate)->age;
            $email = $validator->validated()['email'];
            $address = $validator->validated()['address'];
            $contactNumber = $validator->validated()['contact_number'];
            $status = $validator->validated()['status'];
            $academicYear = $validator->validated()['academic_year'];
            $departmentCode = $validator->validated()['department_code'];
            $yearLevel = $validator->validated()['year_level'];
            $guardianName = $validator->validated()['guardian_name'];
            $guardianContact = $validator->validated()['guardian_contact'];
            
        
            // Now insert data into the database
            $studentId = DB::table('students')->insertGetId([
                'student_number' => $studentNumber,
                'first_name' => $firstName,
                'middle_name' => $middleName,
                'last_name' => $lastName,
                'age' => $age,
                'gender' => $gender,
                'birthdate' => $birthdate,
                'email_address' => $email,
                'current_address' => $address,
                'contact_number' => $contactNumber,
                'enrollment_status' => $status,
                // 'guardian_name' => $guardianName,
                // 'guardian_contact' => $guardianContact,
                
            ]);

            $acad = DB::table('student_school_infos')->insert([
                'student_id' => $studentId,
                'academic_year' => $academicYear,
                'department_code' => $departmentCode,
                'year_level' => $yearLevel,
                
            ]);
        
            return response()->json([
                'status' => 'success',
                'message' => 'Student successfully created!',
                'data' => [
                    'student_id' => $studentId,
                ],
            ], 201);
        
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while creating the student record.',
                'error' => $e->getMessage(),
                
            ], 500);
        }
        
    }



    public function fetchAndInsertStudentData()
{
    // URL of the external API
    $url = 'https://admission.bcpsms3.com/api_students.php';
    
    $response = Http::get($url);

    if ($response->successful()) {
        $studentsData = $response->json();

        foreach ($studentsData as $student) {
            $studentId = DB::table('students')->insertGetId([
                'student_number' => $student['student_number'],
                'first_name' => $student['first_name'],
                'middle_name' => $student['middle_name'] ?? null,  
                'last_name' => $student['last_name'],
                'age' =>  Carbon::parse($student['birthday'])->age, 
                'gender' => $student['sex'],
                'birthdate' => $student['birthday'],
                'email' => $student['email'],
                'address' => $student['address'],
                'contact_number' => $student['contact_number'],
                'status' => $student['status'],
                'academic_year' => $student['academic_year'],
                'department_code' => $student['department_code'],
                'year_level' => $student['year_level'],
                'guardian_name' => $student['guardian_name'],
                'guardian_contact' => $student['guardian_contact'],
                'enrollment_status' => 'enrolled',
            ]);

            $acad = DB::table('student_school_infos')->insert([
                'student_id' => $studentId,
                'academic_year' => $academicYear,
                'department_code' => $departmentCode,
                'year_level' => $yearLevel,
            ]);
        }

        
        return response()->json([
            'status' => 'success',
            'message' => 'Students successfully inserted into the database!',
        ], 201);

    } else {
        
        return response()->json([
            'status' => 'error',
            'message' => 'Failed to fetch data from the external API',
        ], 500);
    }
}

}