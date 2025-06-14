<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use carbon\Carbon;
use Illuminate\Support\Facades\DB;
class AttendanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();
        $students = DB::table('students')->select('id', 'program_id')->get();

        foreach ($students as $student) {
            // Get up to 8 subjects from student's program
            $subjectIds = DB::table('courses')
                ->where('program_id', $student->program_id)
                ->pluck('id')
                ->toArray();

            if (empty($subjectIds)) continue;

            // Ensure we have 8 subjects by duplicating if necessary
            $subjectsForDay = collect($subjectIds)->take(8);
            if ($subjectsForDay->count() < 8) {
                $subjectsForDay = $subjectsForDay->pad(8, $subjectsForDay->first());
            }

            // For last 5 days
            for ($day = 1; $day <= 5; $day++) {
                $attendanceDate = Carbon::now()->subDays($day)->toDateString();

                foreach ($subjectsForDay->values() as $index => $subjectId) {
                    // 10% chance of being absent
                    $isAbsent = rand(1, 10) === 1;

                    // Scheduled subject time (e.g., 7:00 AM + index)
                    $baseTime = Carbon::createFromTime(7 + $index, 0, 0);
                    $checkInTime = $isAbsent
                        ? null
                        : $baseTime->copy()->addMinutes(rand(0, 30)); // up to 30 minutes late

                    // Determine status based on grace period
                    $status = 'absent';
                    if (!$isAbsent) {
                        $status = $checkInTime->lessThanOrEqualTo($baseTime->copy()->addMinutes(15))
                            ? 'present'
                            : 'late';
                    }

                    DB::table('attendances')->insert([
                        'student_id'       => $student->id,
                        'subject_id'       => $subjectId,
                        'attendance_date'  => $attendanceDate,
                        'status'           => $status,
                        'check_in_time'    => $checkInTime?->toTimeString(),
                        'created_at'       => $now,
                        'updated_at'       => $now,
                    ]);
                }
    }
}
    }
}
