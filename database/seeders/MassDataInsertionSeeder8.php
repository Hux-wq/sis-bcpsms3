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

class MassDataInsertionSeeder8 extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'id' => 11,
            'email' => 'hannah.ignacio48@student.com',
            'account_number' => 21128347,
            'email_verified_at' => null,
            'password' =>  Hash::make('Ignacio123?'),
            'account_type' => 'student',
            'remember_token' => null,
        ]);

        UserNameInfo::create([
            'first_name' => 'hannah',
            'middle_name' => 'li',
            'last_name' => 'ignacio',
            'suffix_name' => null,
            'user_id' => 11,
        ]);

        UserBasicInfo::create([
            'age' => 20,
            'gender' => 'female',
            'birthdate' => '2004-11-22',
            'religion' => 'catholic',
            'place_of_birth' => 'quezon city',
            'current_address' => '18 orchid st, sta monica, quezon City',
            'user_id' => 11,
        ]);

        UserContactInfo::create([
            'phone_number' => 9482347677,
            'email_address' => 'hannah.ignacio48@student.com',
            'facebook' => 'https://www.facebook.com/hannah.ignacio48',
            'user_id' => 11, 
        ]);

        UserSchoolInfo::create([
            'position' => null,
            'user_id' => 11,
            'section_id' => 4,
            'current_year' => 2024,
            'current_year_level' => 4,
            'scholastic_type' => 'regular',
        ]);


         //first year
         AcademicRecord::create([
            'user_id' => 11,
            'section_id' => 4,
            'year' => 2021,
            'year_level' => 1,
            'semester' => 1,
            'cumulative_gpa' => 93.1,
        ]);
        AcademicRecord::create([
            'user_id' => 11,
            'section_id' => 4,
            'year' => 2021,
            'year_level' => 1,
            'semester' => 2,
            'cumulative_gpa' => 85.0,
        ]);
        //second Year
        AcademicRecord::create([
            'user_id' => 11,
            'section_id' => 4,
            'year' => 2022,
            'year_level' => 2,
            'semester' => 1,
            'cumulative_gpa' => 85.9,
        ]);
        AcademicRecord::create([
            'user_id' => 11,
            'section_id' => 4,
            'year' => 2022,
            'year_level' => 2,
            'semester' => 2,
            'cumulative_gpa' => 84.9,
        ]);
         //third Year
         AcademicRecord::create([
            'user_id' => 11,
            'section_id' => 4,
            'year' => 2023,
            'year_level' => 3,
            'semester' => 1,
            'cumulative_gpa' => 86.1,
        ]);
        AcademicRecord::create([
            'user_id' => 11,
            'section_id' => 4,
            'year' => 2023,
            'year_level' => 3,
            'semester' => 2,
            'cumulative_gpa' => 91.2,
        ]);
         //fourth Year
         AcademicRecord::create([
            'user_id' => 11,
            'section_id' => 4,
            'year' => 2024,
            'year_level' => 4,
            'semester' => 1,
            'cumulative_gpa' => 88.3,
        ]);
        AcademicRecord::create([
            'user_id' => 11,
            'section_id' => 4,
            'year' => 2024,
            'year_level' => 4,
            'semester' => 2,
            'cumulative_gpa' => 89.4,
        ]);
    }
}
