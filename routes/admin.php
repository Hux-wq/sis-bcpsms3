<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminDocumentController;
use App\Http\Controllers\AdminStudentTableController;
use App\Http\Controllers\AdminPendingEnrolleesController;
use App\Http\Controllers\PendingDocumentController;
use App\Http\Controllers\AdminReportController;
use App\Http\Controllers\AdminRequestController;
use Illuminate\Support\Facades\Route;



Route::get('/dashboard', [AdminDashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('admin.dashboard');

Route::get('/enrollees', [AdminPendingEnrolleesController::class, 'index'])->middleware(['auth', 'verified'])->name('admin.pending-enrollees');

Route::post('/enrollees', [AdminPendingEnrolleesController::class, 'store'])->middleware(['auth', 'verified'])->name('accept-enrollee');

Route::get('/enrollees/{id}/document', [PendingDocumentController::class, 'index'])->middleware(['auth', 'verified'])->name('admin.pending-document');

Route::get('/student', [AdminStudentTableController::class, 'index'])->middleware(['auth', 'verified'])->name('admin.student');



Route::get('/document', [AdminDocumentController::class, 'index'])->middleware(['auth', 'verified'])->name('admin.document');



Route::get('/student/profile/{id}', [AdminStudentTableController::class, 'studentProfile'])->middleware(['auth', 'verified']);
Route::post('/student/UserAccount/Create', [AdminStudentTableController::class, 'studentCreateUserAccount'])->middleware(['auth', 'verified'])->name('studentUserAccount.create');




Route::get('/report', [AdminReportController::class, 'index'])->middleware(['auth', 'verified'])->name('admin.report');


Route::get('/request', [AdminRequestController::class, 'index'])->middleware(['auth', 'verified'])->name('admin.request');

Route::post('/student/{student}/request-document', [AdminRequestController::class, 'submitDocumentRequest'])->middleware(['auth', 'verified'])->name('admin.request.document.submit');
