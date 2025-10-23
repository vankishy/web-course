<?php

use Illuminate\Support\Facades\Route;
use PHPUnit\Framework\Attributes\Group;

Route::prefix('course')->group(function () {
    Route::get('/');
});

Route::get('/', function () {
    return view('welcome');
});
