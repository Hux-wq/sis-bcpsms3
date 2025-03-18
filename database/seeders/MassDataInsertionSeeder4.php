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

class MassDataInsertionSeeder4 extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'id' => 7,
            'email' => 'gabriel.lim12@student.com',
            'account_number' => 21125671,
            'email_verified_at' => null,
            'password' =>  Hash::make('Gabriel123?'),
            'account_type' => 'student',
            'remember_token' => null,
        ]);

        UserNameInfo::create([
            'first_name' => 'gabriel',
            'middle_name' => 'anthony',
            'last_name' => 'lim',
            'suffix_name' => null,
            'user_id' => 7,
        ]);

        UserBasicInfo::create([
            'age' => 21,
            'gender' => 'male',
            'birthdate' => '2003-12-05',
            'religion' => 'None',
            'place_of_birth' => 'San Juan city',
            'current_address' => '398 Domingo Street, Barangay 25, Caloocan City',
            'user_id' => 7,
        ]);

        UserContactInfo::create([
            'phone_number' => 9181234161,
            'email_address' => 'carlos.lopez7@student.com',
            'facebook' => 'https://www.facebook.com/carlos.lopez7',
            'user_id' => 7, 
        ]);

        UserSchoolInfo::create([
            'position' => null,
            'user_id' => 7,
            'section_id' => 3,
            'current_year' => 2024,
            'current_year_level' => 4,
            'scholastic_type' => 'regular',
        ]);


         //first year
         AcademicRecord::create([
            'user_id' => 7,
            'section_id' => 3,
            'year' => 2021,
            'year_level' => 1,
            'semester' => 1,
            'cumulative_gpa' => 91.2,
        ]);
        AcademicRecord::create([
            'user_id' => 7,
            'section_id' => 3,
            'year' => 2021,
            'year_level' => 1,
            'semester' => 2,
            'cumulative_gpa' => 90.7,
        ]);
        //second Year
        AcademicRecord::create([
            'user_id' => 7,
            'section_id' => 3,
            'year' => 2022,
            'year_level' => 2,
            'semester' => 1,
            'cumulative_gpa' => 87.3,
        ]);
        AcademicRecord::create([
            'user_id' => 7,
            'section_id' => 3,
            'year' => 2022,
            'year_level' => 2,
            'semester' => 2,
            'cumulative_gpa' => 88.9,
        ]);
         //third Year
         AcademicRecord::create([
            'user_id' => 7,
            'section_id' => 3,
            'year' => 2023,
            'year_level' => 3,
            'semester' => 1,
            'cumulative_gpa' => 89.9,
        ]);
        AcademicRecord::create([
            'user_id' => 7,
            'section_id' => 3,
            'year' => 2023,
            'year_level' => 3,
            'semester' => 2,
            'cumulative_gpa' => 94.7,
        ]);
         //fourth Year
         AcademicRecord::create([
            'user_id' => 7,
            'section_id' => 3,
            'year' => 2024,
            'year_level' => 4,
            'semester' => 1,
            'cumulative_gpa' => 87.2,
        ]);
        AcademicRecord::create([
            'user_id' => 7,
            'section_id' => 3,
            'year' => 2024,
            'year_level' => 4,
            'semester' => 2,
            'cumulative_gpa' => 89.1,
        ]);
    }
}
