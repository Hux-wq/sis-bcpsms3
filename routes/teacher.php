<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeacherDashboardController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/teacher/dashboard', [TeacherDashboardController::class, 'index'])->name('teacher.dashboard');
    Route::get('/teacher/dashboard/search', [TeacherDashboardController::class, 'searchStudents'])->name('teacher.dashboard.search');

    Route::get('/teacher/input-grades', [TeacherDashboardController::class, 'inputGrades'])->name('teacher.grades.input');
    Route::post('/teacher/input-grades', [TeacherDashboardController::class, 'storeGrades'])->name('teacher.grades.store');

    Route::get('/teacher/input-attendance', [TeacherDashboardController::class, 'inputAttendance'])->name('teacher.attendance.input');
    Route::post('/teacher/input-attendance', [TeacherDashboardController::class, 'storeAttendance'])->name('teacher.attendance.store');
});
