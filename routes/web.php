<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\PageCMSController;
use App\Http\Controllers\FaqController;




Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Protected admin area
Route::middleware('auth')->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // Blog CRUD routes (we'll add the pages in Step 4)
    Route::resource('/admin/blogs', App\Http\Controllers\BlogController::class);
    
    
    // Contact List view.
    Route::get('/admin/contacts', [ContactController::class, 'index'])->name('contacts.index');
    
    // Event Controller    
    Route::resource('events', EventController::class);
    
    Route::resource('programs', ProgramController::class);
    
    
    Route::get('/admin/enrollments', [EnrollmentController::class, 'index'])->name('enrollments.index');
    
    Route::get('/admin/pages/{page_name}', [PageCMSController::class, 'edit'])->name('pages.edit');
    
    Route::resource('faqs', FaqController::class);
});



