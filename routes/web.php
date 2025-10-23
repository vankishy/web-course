<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LeaderboardController;
use Illuminate\Support\Facades\Route;
use PHPUnit\Framework\Attributes\Group;

Route::prefix('course')->group(function () {
    Route::get('/');
});

// Main dashboard routes
Route::get('/', [DashboardController::class, 'index']);
Route::get('/dashboard', [DashboardController::class, 'index']);
Route::get('/leaderboard', [LeaderboardController::class, 'index']);
