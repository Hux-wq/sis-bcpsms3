<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

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
}