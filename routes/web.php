<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AchievementController;
use App\Http\Controllers\InternshipController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\PublicationController;

Route::get('/', function () {
    return redirect()->route('login');
});

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('achievements', AchievementController::class);
    Route::resource('internships', InternshipController::class);
    Route::resource('courses', CourseController::class);
    Route::resource('publications', PublicationController::class);

    Route::get('achievements/{achievement}/document', [AchievementController::class, 'viewDocument'])->name('achievements.document');
    Route::get('internships/{internship}/document', [InternshipController::class, 'viewDocument'])->name('internships.document');
    Route::get('courses/{course}/document', [CourseController::class, 'viewDocument'])->name('courses.document');
    Route::get('publications/{publication}/document', [PublicationController::class, 'viewDocument'])->name('publications.document');
});

