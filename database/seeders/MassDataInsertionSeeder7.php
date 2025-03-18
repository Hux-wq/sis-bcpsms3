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

class MassDataInsertionSeeder7 extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'id' => 10,
            'email' => 'ian.javier50@student.com',
            'account_number' => 21123333,
            'email_verified_at' => null,
            'password' =>  Hash::make('Javier123?'),
            'account_type' => 'student',
            'remember_token' => null,
        ]);

        UserNameInfo::create([
            'first_name' => 'ian',
            'middle_name' => 'anthony',
            'last_name' => 'javier',
            'suffix_name' => null,
            'user_id' => 10,
        ]);

        UserBasicInfo::create([
            'age' => 20,
            'gender' => 'male',
            'birthdate' => '2003-12-05',
            'religion' => 'none',
            'place_of_birth' => 'quezon city',
            'current_address' => '518 Alabang Road, quezon City',
            'user_id' => 10,
        ]);

        UserContactInfo::create([
            'phone_number' => 9672317617,
            'email_address' => 'iam.javier49@student.com',
            'facebook' => 'https://www.facebook.com/ian.javier49',
            'user_id' => 10, 
        ]);

        UserSchoolInfo::create([
            'position' => null,
            'user_id' => 10,
            'section_id' => 4,
            'current_year' => 2024,
            'current_year_level' => 4,
            'scholastic_type' => 'regular',
        ]);


         //first year
         AcademicRecord::create([
            'user_id' => 10,
            'section_id' => 4,
            'year' => 2021,
            'year_level' => 1,
            'semester' => 1,
            'cumulative_gpa' => 93.9,
        ]);
        AcademicRecord::create([
            'user_id' => 10,
            'section_id' => 4,
            'year' => 2021,
            'year_level' => 1,
            'semester' => 2,
            'cumulative_gpa' => 85.9,
        ]);
        //second Year
        AcademicRecord::create([
            'user_id' => 10,
            'section_id' => 4,
            'year' => 2022,
            'year_level' => 2,
            'semester' => 1,
            'cumulative_gpa' => 87.9,
        ]);
        AcademicRecord::create([
            'user_id' => 10,
            'section_id' => 4,
            'year' => 2022,
            'year_level' => 2,
            'semester' => 2,
            'cumulative_gpa' => 88.9,
        ]);
         //third Year
         AcademicRecord::create([
            'user_id' => 10,
            'section_id' => 4,
            'year' => 2023,
            'year_level' => 3,
            'semester' => 1,
            'cumulative_gpa' => 86.8,
        ]);
        AcademicRecord::create([
            'user_id' => 10,
            'section_id' => 4,
            'year' => 2023,
            'year_level' => 3,
            'semester' => 2,
            'cumulative_gpa' => 91.8,
        ]);
         //fourth Year
         AcademicRecord::create([
            'user_id' => 10,
            'section_id' => 4,
            'year' => 2024,
            'year_level' => 4,
            'semester' => 1,
            'cumulative_gpa' => 88.2,
        ]);
        AcademicRecord::create([
            'user_id' => 10,
            'section_id' => 4,
            'year' => 2024,
            'year_level' => 4,
            'semester' => 2,
            'cumulative_gpa' => 89.8,
        ]);
    }
}
