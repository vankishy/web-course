<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LeaderboardController;
use App\Http\Controllers\RoadmapController;
use App\Http\Controllers\AuthControllers; // Pastikan nama controller ini sesuai
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// == LANDING PAGE (HALAMAN AWAL UNTUK SEMUA PENGUNJUNG) ==
// Rute ini sekarang menjadi rute utama untuk '/'
Route::get('/', function () {
    return view('landingpage');
})->name('landing'); // Tetap beri nama 'landing'


// == RUTE UNTUK TAMU (GUEST) ==
// Hanya bisa diakses jika BELUM login.
// Jika sudah login, akan diarahkan ke rute bernama 'dashboard' (yaitu /dashboard)
Route::middleware('guest')->group(function () {
    
    // Halaman Sign Up
    Route::get('/signup', [AuthControllers::class, 'registerPage'])->name('signup');
    // Proses Sign Up
    Route::post('/register', [AuthControllers::class, 'register'])->name('register.process');

    // Halaman Sign In
    Route::get('/signin', [AuthControllers::class, 'loginPage'])->name('signin');
    // Proses Sign In
    Route::post('/login', [AuthControllers::class, 'login'])->name('login.process');
});


// == RUTE UNTUK PENGGUNA YANG SUDAH LOGIN ==
// Hanya bisa diakses jika SUDAH login.
// Jika belum login, akan diarahkan ke rute bernama 'signin' (yaitu /signin)
Route::middleware('auth')->group(function () {

    // Halaman Dashboard Utama SEKARANG PINDAH ke '/dashboard'
    // Nama 'dashboard' tetap digunakan agar redirect setelah login berfungsi
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Halaman Leaderboard
    Route::get('/leaderboard', [LeaderboardController::class, 'index'])->name('leaderboard');

    // Halaman Roadmap
    Route::get('/roadmap', [RoadmapController::class, 'index'])->name('roadmap.index');
    Route::get('/roadmap/{slug}', [RoadmapController::class, 'show'])->name('roadmap.show');

    // Grup Rute Course
    Route::prefix('course')->name('course.')->group(function () {
        Route::get('/', [CourseController::class, 'index'])->name('index');
        Route::get('/subcourse/{id}', [CourseController::class, 'subcourse'])->name('subcourse');
        Route::get('/subcourse/details/{id}', [CourseController::class, 'details'])->name('details');
        Route::post('/markdone/{id}', [CourseController::class, 'markdone'])->name('markdone');
    });

    // Rute '/createuser' Anda, sekarang juga aman
    Route::post('/createuser', [CourseController::class, 'createuser']); // Pertimbangkan memberi nama rute ini

    // 2. ADD THIS ROUTE FOR THE PROFILE
    // This route will show the authenticated user's profile
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    
    // (Optional) Add this if you also want to see other users' profiles
    // Route::get('/profile/{id}', [ProfileController::class, 'show'])->name('profile.user');

    // Proses Logout
    Route::post('/logout', [AuthControllers::class, 'logout'])->name('logout');
});