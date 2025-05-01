<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UploadDocumentController;
use App\Http\Controllers\AdminRequestController;

Route::middleware(['auth', 'admin'])->group(function () {
    Route::post('/admin/requests/{id}/approve', [AdminRequestController::class, 'approve'])->name('admin.requests.approve');
    Route::post('/admin/requests/{id}/decline', [AdminRequestController::class, 'decline'])->name('admin.requests.decline');
});

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth/login');
});

Route::get('/students', function () {
    return view('admin.student');
})->name('students');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::post('/upload/files', [UploadDocumentController::class, 'store'])->name('uploadfiles.store');

require __DIR__.'/auth.php';


require __DIR__.'/admin.php';

require __DIR__.'/student.php';

require __DIR__.'/api.php';


require __DIR__.'/export.php';

Route::delete('/files/{id}', [UploadDocumentController::class, 'destroy'])->name('files.destroy');