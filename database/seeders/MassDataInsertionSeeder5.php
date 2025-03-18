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

class MassDataInsertionSeeder5 extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'id' => 8,
            'email' => 'lara.martinez12@student.com',
            'account_number' => 21125172,
            'email_verified_at' => null,
            'password' =>  Hash::make('Martinez123?'),
            'account_type' => 'student',
            'remember_token' => null,
        ]);

        UserNameInfo::create([
            'first_name' => 'lara',
            'middle_name' => 'limon',
            'last_name' => 'martinez',
            'suffix_name' => null,
            'user_id' => 8,
        ]);

        UserBasicInfo::create([
            'age' => 21,
            'gender' => 'female',
            'birthdate' => '2003-12-05',
            'religion' => 'catholic',
            'place_of_birth' => 'caloocan city',
            'current_address' => '554 Samson Road, Caloocan City',
            'user_id' => 8,
        ]);

        UserContactInfo::create([
            'phone_number' => 9672349666,
            'email_address' => 'lara.martinez12@student.com',
            'facebook' => 'https://www.facebook.com/lara.martinez52',
            'user_id' => 8, 
        ]);

        UserSchoolInfo::create([
            'position' => null,
            'user_id' => 8,
            'section_id' => 3,
            'current_year' => 2024,
            'current_year_level' => 4,
            'scholastic_type' => 'regular',
        ]);


         //first year
         AcademicRecord::create([
            'user_id' => 8,
            'section_id' => 3,
            'year' => 2021,
            'year_level' => 1,
            'semester' => 1,
            'cumulative_gpa' => 93.2,
        ]);
        AcademicRecord::create([
            'user_id' => 8,
            'section_id' => 3,
            'year' => 2021,
            'year_level' => 1,
            'semester' => 2,
            'cumulative_gpa' => 85.7,
        ]);
        //second Year
        AcademicRecord::create([
            'user_id' => 8,
            'section_id' => 3,
            'year' => 2022,
            'year_level' => 2,
            'semester' => 1,
            'cumulative_gpa' => 87.1,
        ]);
        AcademicRecord::create([
            'user_id' => 8,
            'section_id' => 3,
            'year' => 2022,
            'year_level' => 2,
            'semester' => 2,
            'cumulative_gpa' => 83.9,
        ]);
         //third Year
         AcademicRecord::create([
            'user_id' => 8,
            'section_id' => 3,
            'year' => 2023,
            'year_level' => 3,
            'semester' => 1,
            'cumulative_gpa' => 86.6,
        ]);
        AcademicRecord::create([
            'user_id' => 8,
            'section_id' => 3,
            'year' => 2023,
            'year_level' => 3,
            'semester' => 2,
            'cumulative_gpa' => 91.7,
        ]);
         //fourth Year
         AcademicRecord::create([
            'user_id' => 8,
            'section_id' => 3,
            'year' => 2024,
            'year_level' => 4,
            'semester' => 1,
            'cumulative_gpa' => 89.2,
        ]);
        AcademicRecord::create([
            'user_id' => 8,
            'section_id' => 3,
            'year' => 2024,
            'year_level' => 4,
            'semester' => 2,
            'cumulative_gpa' => 89.1,
        ]);
    }
}
