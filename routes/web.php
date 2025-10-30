<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LeaderboardController;
use App\Http\Controllers\RoadmapController;
use App\Http\Controllers\ProfileController; // <-- ADDED THIS LINE
use Illuminate\Support\Facades\Route;
use PHPUnit\Framework\Attributes\Group;

Route::prefix('course')->name('course.')->group(function () {
    Route::get('/', [CourseController::class, 'index'])->name('index');
    Route::get('/subcourse/{id}', [CourseController::class, 'subcourse'])->name('subcourse');
    Route::get('/subcourse/details/{id}', [CourseController::class, 'details'])->name('details');
    Route::post('/markdone/{id}', [CourseController::class, 'markdone'])->name('markdone');
});
Route::post('/createuser', [CourseController::class, 'createuser']);

// Main dashboard routes
Route::get('/', [DashboardController::class, 'index']);
Route::get('/dashboard', [DashboardController::class, 'index']);
Route::get('/leaderboard', [LeaderboardController::class, 'index']);
Route::get('/roadmap', [RoadmapController::class, 'index'])->name('roadmap.index');

// --- ADDED PROFILE ROUTES ---
// This route handles the logged-in user's profile (e.g., /profile)
Route::get('/profile', [ProfileController::class, 'show'])
    // ->middleware('auth') // Ensures only logged-in users can access
    ->name('profile.me'); // We use this name for the navbar link

// This route handles viewing ANY user's profile by their ID (e.g., /profile/1)
Route::get('/profile/{user}', [ProfileController::class, 'show'])
    ->name('profile.show');

// NOTE: The extra '}' from your original file has been removed as it was a syntax error.
