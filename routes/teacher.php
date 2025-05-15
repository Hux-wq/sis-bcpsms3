<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeacherDashboardController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/teacher/dashboard', [TeacherDashboardController::class, 'index'])->name('teacher.dashboard');
});
