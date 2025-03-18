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

class MassDataInsertionSeeder2 extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'id' => 5,
            'email' => 'lauramae.silva4@student.com',
            'account_number' => 21035078,
            'email_verified_at' => null,
            'password' =>  Hash::make('Silva123?'),
            'account_type' => 'student',
            'remember_token' => null,
        ]);

        UserNameInfo::create([
            'first_name' => 'laura mae',
            'middle_name' => 'torre',
            'last_name' => 'silva',
            'suffix_name' => null,
            'user_id' => 5,
        ]);

        UserBasicInfo::create([
            'age' => 19,
            'gender' => 'female',
            'birthdate' => '2005-06-25',
            'religion' => 'christian',
            'place_of_birth' => 'Mandaluyong City',
            'current_address' => '45 Acacia St, Barangay Plainview, Mandaluyong City',
            'user_id' => 5,
        ]);

        UserContactInfo::create([
            'phone_number' => 9192345678,
            'email_address' => 'lauramae.silva4@student.com',
            'facebook' => 'https://www.facebook.co/laura.silva.4',
            'user_id' => 5, 
        ]);

        UserSchoolInfo::create([
            'position' => null,
            'user_id' => 5,
            'section_id' => 1,
            'current_year' => 2024,
            'current_year_level' => 4,
            'scholastic_type' => 'regular',
        ]);


         //first year
         AcademicRecord::create([
            'user_id' => 5,
            'section_id' => 1,
            'year' => 2021,
            'year_level' => 1,
            'semester' => 1,
            'cumulative_gpa' => 90.2,
        ]);
        AcademicRecord::create([
            'user_id' => 5,
            'section_id' => 1,
            'year' => 2021,
            'year_level' => 1,
            'semester' => 2,
            'cumulative_gpa' => 90.1,
        ]);
        //second Year
        AcademicRecord::create([
            'user_id' => 5,
            'section_id' => 1,
            'year' => 2022,
            'year_level' => 2,
            'semester' => 1,
            'cumulative_gpa' => 92.3,
        ]);
        AcademicRecord::create([
            'user_id' => 5,
            'section_id' => 1,
            'year' => 2022,
            'year_level' => 2,
            'semester' => 2,
            'cumulative_gpa' => 93.9,
        ]);
         //third Year
         AcademicRecord::create([
            'user_id' => 5,
            'section_id' => 1,
            'year' => 2023,
            'year_level' => 3,
            'semester' => 1,
            'cumulative_gpa' => 90.9,
        ]);
        AcademicRecord::create([
            'user_id' => 5,
            'section_id' => 1,
            'year' => 2023,
            'year_level' => 3,
            'semester' => 2,
            'cumulative_gpa' => 90.7,
        ]);
         //fourth Year
         AcademicRecord::create([
            'user_id' => 5,
            'section_id' => 1,
            'year' => 2024,
            'year_level' => 4,
            'semester' => 1,
            'cumulative_gpa' => 88.2,
        ]);
        AcademicRecord::create([
            'user_id' => 5,
            'section_id' => 1,
            'year' => 2024,
            'year_level' => 4,
            'semester' => 2,
            'cumulative_gpa' => 91.1,
        ]);
    }
}
