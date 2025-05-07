<?php

namespace App\Helpers;

use App\Models\Student;

class UserHelper
{
    public static function GetUserName($id)
    {
        $user = Student::find($id);

        if (!$user) {
            return 'Unknown User';
        }

        return trim("{$user->first_name} {$user->middle_name} {$user->last_name}");
    }

    public static function GetStudentNumber($id)
    {
        $user = Student::find($id);

        return $user->student_number ?? 'N/A';
    }
}
