<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Menampilkan beranda atau mengarahkan pengguna yang sudah masuk ke dashboard.
Route::get('/', fn () => Auth::check()
    ? redirect()->route('dashboard')
    : view('welcome'))->name('home');

// Membatasi halaman login dan pendaftaran untuk pengunjung yang belum masuk.
Route::middleware('guest')->group(function (): void {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:5,1')->name('login.store');
    Route::get('/register', [AuthController::class, 'showRegistration'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.store');
});

// Mengakhiri sesi akun yang sedang masuk.
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// Melindungi dashboard dan memeriksa role untuk setiap area.
Route::middleware('auth')->group(function (): void {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/admin/dashboard', [DashboardController::class, 'show'])
        ->middleware('role:admin')
        ->name('admin.dashboard');
    Route::get('/petugas/dashboard', [DashboardController::class, 'show'])
        ->middleware('role:petugas')
        ->name('petugas.dashboard');
    Route::get('/customer/dashboard', [DashboardController::class, 'show'])
        ->middleware('role:customer')
        ->name('customer.dashboard');
});
