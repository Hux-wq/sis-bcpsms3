<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class StudentAcademicRecords extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $studentIds = range(1, 201);
        $records = [];

        foreach ($studentIds as $studentId) {
            for ($yearLevel = 1; $yearLevel <= 4; $yearLevel++) {
                for ($semester = 1; $semester <= 2; $semester++) {
                    $startYear = rand(2018, 2025);                                                                                      
                    $schoolYear = $startYear . '-' . ($startYear + 1);
                    $records[] = [
                        'student_id' => $studentId,
                        'section_id' => rand(1, 8),
                        'school_year' => $schoolYear,
                        'year_level' => $yearLevel,
                        'semester' => $semester,
                        'cumulative_gpa' => number_format(rand(200, 400) / 100, 2),
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ];
                }
            }
        }

        DB::table('academic_records')->insert($records);
    }
}
