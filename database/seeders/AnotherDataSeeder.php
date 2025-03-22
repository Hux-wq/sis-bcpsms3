<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AnotherDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Student Data (Tenth Student - Elementary Education)
    $studentData11 = [
        'student_number' => 21952144,
        'first_name' => 'nacua',
        'middle_name' => 'kate',
        'last_name' => 'Fernandez',
        'suffix_name' => null,
        'age' => 21,
        'gender' => 'female',
        'birthdate' => '2002-04-10',
        'religion' => 'Catholic',
        'place_of_birth' => 'Baguio City',
        'current_address' => '223 Nagkaisa Rd, Quezon City',
        'email_address' => 'knacua862@gmail.com',
        'contact_number' => '09110099887',
    
        'program_id' => 1,
        'enrollment_status' => 'Enrolled',
    ];

    $studentId11 = DB::table('students')->insertGetId($studentData11);

    $studentData12 = [
        'student_number' => 21952178,
        'first_name' => 'nacua',
        'middle_name' => 'kimberly',
        'last_name' => 'Fernandez',
        'suffix_name' => null,
        'age' => 22,
        'gender' => 'female',
        'birthdate' => '2002-03-09',
        'religion' => 'Catholic',
        'place_of_birth' => 'Baguio City',
        'current_address' => '223 Nagkaisa Rd, Quezon City',
        'email_address' => 'knacua0103@gmail.com',
        'contact_number' => '09110077881',
    
        'program_id' => 1,
        'enrollment_status' => 'Enrolled',
    ];

    $studentId12 = DB::table('students')->insertGetId($studentData12);


    $studentData13 = [
        'student_number' => 21956679,
        'first_name' => 'shoe',
        'middle_name' => 'Snow',
        'last_name' => 'lee',
        'suffix_name' => null,
        'age' => 23,
        'gender' => 'female',
        'birthdate' => '2001-01-01',
        'religion' => 'Catholic',
        'place_of_birth' => 'Baguio City',
        'current_address' => '223 Nagkaisa Rd, Quezon City',
        'email_address' => 'snowshoe0103@gmail.com',
        'contact_number' => '09916077681',
    
        'program_id' => 1,
        'enrollment_status' => 'Enrolled',
    ];

    $studentId13 = DB::table('students')->insertGetId($studentData13);




    }
}
