<?php

use App\Http\Controllers\DataExportController;
use Illuminate\Support\Facades\Route;



Route::get('/export-students',[DataExportController::class, 'exportStudents']);

Route::get('/students/export/filtered', [DataExportController::class, 'exportFilteredStudents']);
