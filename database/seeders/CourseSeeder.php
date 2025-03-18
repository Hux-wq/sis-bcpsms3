<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Course;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Course::create([
            'course_code' => 'CS101',
            'title' => 'Introduction to Computer Science',
            'description' => 'An introductory course on computer science principles and practices.',
            'program_id' => 1,
            'department_id' => 1, 
            'credits' => 3,
            'level' => 1,
            'is_active' => true,
        ]);

        
    }
}
