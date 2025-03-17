<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminDocumentController;
use App\Http\Controllers\AdminStudentTableController;
use Illuminate\Support\Facades\Route;



Route::get('/dashboard', [AdminDashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('admin.dashboard');



Route::get('/student', [AdminStudentTableController::class, 'index'])->middleware(['auth', 'verified'])->name('admin.student');



Route::get('/document', [AdminDocumentController::class, 'index'])->middleware(['auth', 'verified'])->name('admin.document');



Route::get('/student/profile/{id}', [AdminStudentTableController::class, 'studentProfile'])->middleware(['auth', 'verified']);
