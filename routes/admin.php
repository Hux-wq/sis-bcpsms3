 <?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminDocumentController;
use App\Http\Controllers\AdminStudentTableController;
use App\Http\Controllers\AdminPendingEnrolleesController;
use App\Http\Controllers\PendingDocumentController;
use App\Http\Controllers\AdminReportController;
use App\Http\Controllers\AdminRequestController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Student;



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

Route::get('/returnee', [App\Http\Controllers\AdminStudentTableController::class, 'returnee'])->name('admin.returnee');
Route::get('/transferee', [App\Http\Controllers\AdminStudentTableController::class, 'transferee'])->name('admin.transferee');
Route::get('/octoberian', [App\Http\Controllers\AdminStudentTableController::class, 'octoberian'])->name('admin.octoberian');
Route::get('/graduated', [App\Http\Controllers\AdminStudentTableController::class, 'graduated'])->name('admin.graduated');
Route::get('/droppedout', [App\Http\Controllers\AdminStudentTableController::class, 'droppedout'])->name('admin.droppedout');
Route::get('/failed', [App\Http\Controllers\AdminStudentTableController::class, 'failed'])->name('admin.failed');



Route::get('/account-creation', function () {
    return view('admin.account-creation');
})->middleware(['auth', 'verified'])->name('admin.account.creation');

use Illuminate\Http\Request;

Route::post('/teacher/account/create', function (Request $request) {
    $validated = $request->validate([
        'teacher_name' => 'required|string|max:255',
        'teacher_email' => 'required|string|email|max:255|unique:users,email',
        'teacher_password' => 'required|string|min:8',
        'teacher_account_type' => 'required|string|in:department_head,teacher',
    ]);
    $user = new User();
    $user->name = $validated['teacher_name'];
    $user->email = $validated['teacher_email'];
    $user->password = Hash::make($validated['teacher_password']);
    $user->acc_type = $validated['teacher_account_type'];
    $user->save();
    return back()->with('success', 'Teacher account created successfully.');
})->middleware(['auth', 'verified'])->name('admin.teacher.account.create');

Route::get('/admin/teachers', [\App\Http\Controllers\AdminTeacherController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('admin.teachers.index');

Route::get('/admin/teachers/{id}/profile', [\App\Http\Controllers\AdminTeacherController::class, 'showProfile'])
    ->middleware(['auth', 'verified'])
    ->name('admin.teachers.profile');

Route::put('/admin/teachers/{id}/profile', [\App\Http\Controllers\AdminTeacherController::class, 'updateProfile'])
    ->middleware(['auth', 'verified'])
    ->name('admin.teachers.updateProfile');

Route::post('/student/account/create', function () {
    // TODO: Implement student account creation logic
    return back()->with('success', 'Student account created successfully.');
})->middleware(['auth', 'verified'])->name('admin.student.account.create');
    
Route::post('/student/accounts/create/all', function (\Illuminate\Http\Request $request) {
    $request->validate([
        'student_category' => 'required|string|in:Enrolled,Transferee,Returnee,Octoberian',
    ]);

    $category = $request->input('student_category');

    $students = \App\Models\Student::where('enrollment_status', $category)->get();

    $createdCount = 0;
    $skippedCount = 0;

    foreach ($students as $student) {
        $existingUser = \App\Models\User::where('linking_id', $student->id)->first();
        if (!$existingUser) {
            \App\Models\User::create([
                'name' => $student->first_name . ' ' . $student->last_name,
                'email' => $student->student_number . '@student.com',
                'password' => \Illuminate\Support\Facades\Hash::make($student->last_name . '1234!'),
                'linking_id' => $student->id,
                'acc_type' => 'student',
            ]);
            $createdCount++;
        } else {
            $skippedCount++;
        }
    }

    return back()->with('success', "Student accounts created successfully for category '{$category}'. Created: {$createdCount}, Skipped (already exist): {$skippedCount}.");
})->middleware(['auth', 'verified'])->name('admin.student.accounts.create.all');

