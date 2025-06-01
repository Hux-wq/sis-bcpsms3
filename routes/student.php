<?php

use App\Http\Controllers\StudentDashboardController;
use App\Http\Controllers\StudentDocumentController;
use App\Http\Controllers\StudentRequestController;
use Illuminate\Support\Facades\Route;


Route::get('/s/dashboard', [StudentDashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('student.dashboard');
Route::get('/s/document', [StudentDocumentController::class, 'index'])->middleware(['auth', 'verified'])->name('student.document');
Route::get('/s/request', [StudentRequestController::class, 'index'])->middleware(['auth', 'verified'])->name('student.request');
Route::post('/s/request', [StudentRequestController::class, 'store'])->middleware(['auth', 'verified'])->name('student.request.post');

Route::get('/s/courses', [\App\Http\Controllers\StudentDashboardController::class, 'courses'])->middleware(['auth', 'verified'])->name('student.courses');
