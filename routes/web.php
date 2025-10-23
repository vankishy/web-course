<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LeaderboardController;
use Illuminate\Support\Facades\Route;

// Main dashboard routes
Route::get('/', [DashboardController::class, 'index']);
Route::get('/dashboard', [DashboardController::class, 'index']);
Route::get('/leaderboard', [LeaderboardController::class, 'index']);
