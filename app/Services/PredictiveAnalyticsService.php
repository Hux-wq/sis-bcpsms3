<?php

namespace App\Services;

use App\Models\Attendance;
use App\Models\Grade;
use App\Models\Student;

class PredictiveAnalyticsService
{
    /**
     * Predict the grade category for a student based on attendance and last grade.
     * This is a simplified alternative approach without using external ML libraries.
     */
    public function predictGradeCategory($studentId, $lastGrade)
    {
        // Calculate average attendance for the student
        // $attendanceRecords = Attendance::where('student_id', $studentId)->get();
        // $attendanceCount = $attendanceRecords->count();
        // $presentCount = $attendanceRecords->where('status', 'present')->count();
        // $attendanceRate = $attendanceCount > 0 ? $presentCount / $attendanceCount : 0;


        if ($lastGrade == 0.0) {
            return 'Fail';
        } elseif ($lastGrade <= 1.5) {
            return 'High Performer';
        } elseif ($lastGrade <= 2.75) {
            return 'Pass';
        } elseif ($lastGrade > 2.75 && $lastGrade <= 3.0) {
            return 'At Risk';
        } else {
            return 'Fail';
        }
    }

    /**
     * Predict counts of students in each category: pass, at risk, fail.
     *
     * @return array
     */
    public function predictStudentCounts()
    {
        // Fetch students excluding those with enrollment_status Dropped Out, Graduated, or Failed
        $students = Student::whereNotIn('enrollment_status', ['Dropped Out', 'Graduated', 'Failed'])->get();
        $counts = [
            'High Performer' => 0,
            'Pass' => 0,
            'At Risk' => 0,
            'Fail' => 0,
        ];

        foreach ($students as $student) {
            // Get all grades for the student
            $gradeRecords = Grade::where('student_id', $student->id)->get();

            if ($gradeRecords->isEmpty()) {
                // If no grade record, consider as fail or skip
                $counts['Fail']++;
                continue;
            }

            // Compute average grade by summing all grades and dividing by total count
            $totalGrades = 0;
            $gradeCount = 0;
            foreach ($gradeRecords as $gradeRecord) {
                $totalGrades += $gradeRecord->grade;
                $gradeCount++;
            }
            $averageGrade = $gradeCount > 0 ? $totalGrades / $gradeCount : 0;

            $category = $this->predictGradeCategory($student->id, $averageGrade);
            if (isset($counts[$category])) {
                $counts[$category]++;
            }
        }

        return $counts;
    }

    /**
     * Get detailed breakdown of all students with their average grade and category.
     *
     * @return array
     */
    public function getDetailedStudentBreakdown()
    {
        $students = Student::whereNotIn('enrollment_status', ['Dropped Out', 'Graduated', 'Failed'])->get();
        $breakdown = [];

        foreach ($students as $student) {
            $gradeRecords = Grade::where('student_id', $student->id)->get();

            $totalGrades = 0;
            $gradeCount = 0;
            foreach ($gradeRecords as $gradeRecord) {
                $totalGrades += $gradeRecord->grade;
                $gradeCount++;
            }
            $averageGrade = $gradeCount > 0 ? $totalGrades / $gradeCount : 0;

            // Map average grade to frontend category names
            if ($averageGrade == 0.0) {    
                $category = 'Fail';
            } elseif ($averageGrade <= 1.5) {
                $category = 'High Performer';
            } elseif ($averageGrade <= 2.75) {
                $category = 'Average';
            } elseif ($averageGrade > 2.75 && $averageGrade <= 3.0) {
                $category = 'At Risk';
            } else {
                $category = 'Fail';
            }
        
            $breakdown[] = [
                'student_number' => $student->student_number,
                'student_name' => $student->first_name . ' ' . $student->last_name,
                'average_grade' => $averageGrade,
                'category' => $category,
            ];
        }

        return $breakdown;
    }
}
