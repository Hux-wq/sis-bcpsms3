<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use carbon\Carbon;
class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    
       $grades = [1.0, 1.25, 1.5, 1.75, 2.0, 2.25, 2.5, 2.75, 3.0];
        $gradingPeriods = ['1st Semester', '2nd Semester'];
        $now = Carbon::now();

        // Get all students with program and status
        $students = DB::table('students')->select('id', 'program_id', 'enrollment_status')->get();

        foreach ($students as $student) {
            $isFailedStatus = in_array($student->enrollment_status, ['Failed', 'Dropped Out']);

            // Get courses under the student's program
            $courseIds = DB::table('courses')
                ->where('program_id', $student->program_id)
                ->pluck('id')
                ->toArray();

            // Skip if no courses available in that program
            if (count($courseIds) < 1) {
                continue;
            }


            $selectedCourses = collect($courseIds)->random(min(10, count($courseIds)));

            foreach ($selectedCourses as $courseId) {
                $grade = $isFailedStatus ? 5.0 : $grades[array_rand($grades)];
                $remarks = $isFailedStatus || $grade > 3.0 ? 'Failed' : 'Passed';

                DB::table('grades')->insert([
                    'student_id'      => $student->id,
                    'course_id'       => $courseId,
                    'program_id'      => $student->program_id,
                    'grade'           => $grade,
                    'remarks'         => $remarks,
                    'grading_period'  => $gradingPeriods[array_rand($gradingPeriods)],
                    'created_at'      => $now,
                    'updated_at'      => $now,
                ]);
        }
    }
}
}