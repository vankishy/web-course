<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;

// UNPROTECTED ROUTE
Route::post('/createuser', [CourseController::class, 'createuser']);

// PROTECTED API ROUTE FOR TESTING
Route::middleware('auth.custom')->group(function () {
    Route::get('/user/me', function (Request $request) {
        return response()->json($request->user());
    });
});