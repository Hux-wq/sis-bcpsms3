<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AcademicRecord;

class AcademicRecordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {       
            //first year
            AcademicRecord::create([
                'id' => 1,
                'user_id' => 3,
                'section_id' => 1,
                'year' => 2021,
                'year_level' => 1,
                'semester' => 1,
                'cumulative_gpa' => 93.2,
            ]);
            AcademicRecord::create([
                'id' => 2,
                'user_id' => 3,
                'section_id' => 1,
                'year' => 2021,
                'year_level' => 1,
                'semester' => 2,
                'cumulative_gpa' => 90.1,
            ]);
            //second Year
            AcademicRecord::create([
                'id' => 3,
                'user_id' => 3,
                'section_id' => 1,
                'year' => 2022,
                'year_level' => 2,
                'semester' => 1,
                'cumulative_gpa' => 91.2,
            ]);
            AcademicRecord::create([
                'id' => 4,
                'user_id' => 3,
                'section_id' => 1,
                'year' => 2022,
                'year_level' => 2,
                'semester' => 2,
                'cumulative_gpa' => 90.1,
            ]);
             //third Year
             AcademicRecord::create([
                'id' => 5,
                'user_id' => 3,
                'section_id' => 1,
                'year' => 2023,
                'year_level' => 3,
                'semester' => 1,
                'cumulative_gpa' => 90.5,
            ]);
            AcademicRecord::create([
                'id' => 6,
                'user_id' => 3,
                'section_id' => 1,
                'year' => 2023,
                'year_level' => 3,
                'semester' => 2,
                'cumulative_gpa' => 91.7,
            ]);
             //fourth Year
             AcademicRecord::create([
                'id' => 7,
                'user_id' => 3,
                'section_id' => 1,
                'year' => 2024,
                'year_level' => 4,
                'semester' => 1,
                'cumulative_gpa' => 91.2,
            ]);
            AcademicRecord::create([
                'id' => 8,
                'user_id' => 3,
                'section_id' => 1,
                'year' => 2024,
                'year_level' => 4,
                'semester' => 2,
                'cumulative_gpa' => 90.1,
            ]);


    }
}
