<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LeaderboardController;
use App\Http\Controllers\RoadmapController;
use App\Http\Controllers\AuthControllers;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landingpage');
})->name('landing');

Route::middleware('guest')->group(function () {
    Route::get('/signup', [AuthControllers::class, 'registerPage'])->name('signup');
    Route::post('/register', [AuthControllers::class, 'register'])->name('register.process');
    Route::get('/signin', [AuthControllers::class, 'loginPage'])->name('signin');
    Route::post('/login', [AuthControllers::class, 'login'])->name('login.process');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/leaderboard', [LeaderboardController::class, 'index'])->name('leaderboard');
    Route::post('/leaderboard/update-rankings', [LeaderboardController::class, 'updateRankings'])
        ->name('leaderboard.update');

    Route::get('/roadmap', [RoadmapController::class, 'index'])->name('roadmap.index');
    Route::get('/roadmap/{slug}', [RoadmapController::class, 'show'])->name('roadmap.show');

    Route::prefix('course')->name('course.')->group(function () {
        Route::get('/', [CourseController::class, 'index'])->name('index');
        Route::get('/subcourse/{id}', [CourseController::class, 'subcourse'])->name('subcourse');
        Route::get('/subcourse/details/{id}', [CourseController::class, 'details'])->name('details');
        Route::post('/markdone/{id}', [CourseController::class, 'markdone'])->name('markdone');
    });

    Route::post('/createuser', [CourseController::class, 'createuser']);

    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    // Route::get('/profile/{id}', [ProfileController::class, 'show'])->name('profile.user');

    Route::post('/logout', [AuthControllers::class, 'logout'])->name('logout');
});