<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            DocumentListSeeder::class,
            AdminSeeder::class,
            MassSeeder::class,
            SectionSeeder::class,
            // UserSeeder::class,
            // UserNameSeeder::class,
            // UserBasicSeeder::class,
            // UserContactSeeder::class,
            // DepartmentSeeder::class,
            // ProgramSeeder::class,
            // CourseSeeder::class,
            // SectionSeeder::class,
            // UserSchoolInfoSeeder::class,
            // AcademicRecordSeeder::class,
            // MassDataInsertionSeeder::class,
            // MassDataInsertionSeeder2::class,
            // MassDataInsertionSeeder3::class,
            // MassDataInsertionSeeder4::class,
            // MassDataInsertionSeeder5::class,
            // MassDataInsertionSeeder6::class,
            // MassDataInsertionSeeder7::class,
            // MassDataInsertionSeeder8::class,
            // MassDataInsertionSeeder9::class,
        ]);
    }
}
