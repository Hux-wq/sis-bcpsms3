<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\UploadFiles;
use App\Models\Student;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Share recent uploads and recent enrolled students with all views
        View::composer('layouts.header', function ($view) {
            $recentUploads = UploadFiles::with('user')->orderBy('created_at', 'desc')->limit(5)->get();
            $recentEnrolledStudents = Student::with('program')->where('enrollment_status', 'Enrolled')->orderBy('created_at', 'desc')->limit(5)->get();
            $view->with('recentUploads', $recentUploads)
                 ->with('recentEnrolledStudents', $recentEnrolledStudents);
        });
    }
}
