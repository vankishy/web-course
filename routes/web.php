<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

// Main dashboard routes
Route::get('/', [DashboardController::class, 'index']);
Route::get('/dashboard', [DashboardController::class, 'index']);
