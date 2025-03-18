<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\UserNameInfo;
use App\Models\UserBasicInfo;
use App\Models\UserContactInfo;
use App\Models\UserSchoolInfo;
use App\Models\AcademicRecord;

class MassDataInsertionSeeder6 extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'id' => 9,
            'email' => 'jasmin.kim50@student.com',
            'account_number' => 21122022,
            'email_verified_at' => null,
            'password' =>  Hash::make('Jasmin123?'),
            'account_type' => 'student',
            'remember_token' => null,
        ]);

        UserNameInfo::create([
            'first_name' => 'jasmin',
            'middle_name' => 'simeon',
            'last_name' => 'kim',
            'suffix_name' => null,
            'user_id' => 9,
        ]);

        UserBasicInfo::create([
            'age' => 20,
            'gender' => 'female',
            'birthdate' => '2004-11-18',
            'religion' => 'christian',
            'place_of_birth' => 'caloocan city',
            'current_address' => '122 National Road, Caloocan City',
            'user_id' => 9,
        ]);

        UserContactInfo::create([
            'phone_number' => 9672349666,
            'email_address' => 'jasmin.kim12@student.com',
            'facebook' => 'https://www.facebook.com/jasmin.kim50',
            'user_id' => 9, 
        ]);

        UserSchoolInfo::create([
            'position' => null,
            'user_id' => 9,
            'section_id' => 4,
            'current_year' => 2024,
            'current_year_level' => 4,
            'scholastic_type' => 'regular',
        ]);


         //first year
         AcademicRecord::create([
            'user_id' => 9,
            'section_id' => 4,
            'year' => 2021,
            'year_level' => 1,
            'semester' => 1,
            'cumulative_gpa' => 93.2,
        ]);
        AcademicRecord::create([
            'user_id' => 9,
            'section_id' => 4,
            'year' => 2021,
            'year_level' => 1,
            'semester' => 2,
            'cumulative_gpa' => 85.7,
        ]);
        //second Year
        AcademicRecord::create([
            'user_id' => 9,
            'section_id' => 4,
            'year' => 2022,
            'year_level' => 2,
            'semester' => 1,
            'cumulative_gpa' => 87.1,
        ]);
        AcademicRecord::create([
            'user_id' => 9,
            'section_id' => 4,
            'year' => 2022,
            'year_level' => 2,
            'semester' => 2,
            'cumulative_gpa' => 83.9,
        ]);
         //third Year
         AcademicRecord::create([
            'user_id' => 9,
            'section_id' => 4,
            'year' => 2023,
            'year_level' => 3,
            'semester' => 1,
            'cumulative_gpa' => 86.6,
        ]);
        AcademicRecord::create([
            'user_id' => 9,
            'section_id' => 4,
            'year' => 2023,
            'year_level' => 3,
            'semester' => 2,
            'cumulative_gpa' => 91.7,
        ]);
         //fourth Year
         AcademicRecord::create([
            'user_id' => 9,
            'section_id' => 4,
            'year' => 2024,
            'year_level' => 4,
            'semester' => 1,
            'cumulative_gpa' => 89.2,
        ]);
        AcademicRecord::create([
            'user_id' => 9,
            'section_id' => 4,
            'year' => 2024,
            'year_level' => 4,
            'semester' => 2,
            'cumulative_gpa' => 89.1,
        ]);
    }
}
