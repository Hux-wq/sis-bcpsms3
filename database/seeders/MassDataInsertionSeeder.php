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

class MassDataInsertionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'id' => 4,
            'email' => 'martin.rodriguez5@student.com',
            'account_number' => 21120455,
            'email_verified_at' => null,
            'password' =>  Hash::make('Martin123?'),
            'account_type' => 'student',
            'remember_token' => null,
        ]);

        UserNameInfo::create([
            'first_name' => 'martin',
            'middle_name' => 'andres',
            'last_name' => 'rodriguez',
            'suffix_name' => null,
            'user_id' => 4,
        ]);

        UserBasicInfo::create([
            'age' => 22,
            'gender' => 'male',
            'birthdate' => '2002-09-17',
            'religion' => 'catholic',
            'place_of_birth' => 'Quezon City',
            'current_address' => 'Gulod, Novaliches, Quezon City',
            'user_id' => 4,
        ]);

        UserContactInfo::create([
            'phone_number' => 9387161706,
            'email_address' => 'mark.marquez3@student.com',
            'facebook' => 'https://www.facebook.co/marque.z.3',
            'user_id' => 4, 
        ]);

        UserSchoolInfo::create([
            'position' => null,
            'user_id' => 4,
            'section_id' => 1,
            'current_year' => 2024,
            'current_year_level' => 4,
            'scholastic_type' => 'regular',
        ]);

         //first year
         AcademicRecord::create([
            'user_id' => 4,
            'section_id' => 1,
            'year' => 2021,
            'year_level' => 1,
            'semester' => 1,
            'cumulative_gpa' => 93.2,
        ]);
        AcademicRecord::create([
            'user_id' => 4,
            'section_id' => 1,
            'year' => 2021,
            'year_level' => 1,
            'semester' => 2,
            'cumulative_gpa' => 90.1,
        ]);
        //second Year
        AcademicRecord::create([
            'user_id' => 4,
            'section_id' => 1,
            'year' => 2022,
            'year_level' => 2,
            'semester' => 1,
            'cumulative_gpa' => 92.3,
        ]);
        AcademicRecord::create([
            'user_id' => 4,
            'section_id' => 1,
            'year' => 2022,
            'year_level' => 2,
            'semester' => 2,
            'cumulative_gpa' => 90.9,
        ]);
         //third Year
         AcademicRecord::create([
            'user_id' => 4,
            'section_id' => 1,
            'year' => 2023,
            'year_level' => 3,
            'semester' => 1,
            'cumulative_gpa' => 90.5,
        ]);
        AcademicRecord::create([
            'user_id' => 4,
            'section_id' => 1,
            'year' => 2023,
            'year_level' => 3,
            'semester' => 2,
            'cumulative_gpa' => 92.7,
        ]);
         //fourth Year
         AcademicRecord::create([
            'user_id' => 4,
            'section_id' => 1,
            'year' => 2024,
            'year_level' => 4,
            'semester' => 1,
            'cumulative_gpa' => 89.2,
        ]);
        AcademicRecord::create([
            'user_id' => 4,
            'section_id' => 1,
            'year' => 2024,
            'year_level' => 4,
            'semester' => 2,
            'cumulative_gpa' => 93.1,
        ]);
    }

}
