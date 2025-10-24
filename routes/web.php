<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LeaderboardController;
use App\Http\Controllers\RoadmapController;
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
