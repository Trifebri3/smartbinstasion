<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicMonitorController;
use App\Http\Controllers\Auth\GoogleAuthController;
use App\Http\Controllers\UserPortalController;
use App\Http\Controllers\ServoController;
use App\Http\Middleware\EnsureUserIsAdmin;

// Layar Tampilan Publik SmartBin (smartbin.myoin.id)
Route::get('/', [PublicMonitorController::class, 'index'])->name('home');
Route::get('/monitor', [PublicMonitorController::class, 'index'])->name('public.monitor');
Route::get('/public-monitor', [PublicMonitorController::class, 'index'])->name('public.monitor.alias');

// Autentikasi Google OAuth
Route::get('/auth/google', [GoogleAuthController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [GoogleAuthController::class, 'handleGoogleCallback'])->name('auth.google.callback');

// Portal Pengguna (Google User: Poin, QR Code Deposit, Scan HP, Edukasi)
Route::middleware('auth')->group(function () {
    Route::get('/portal', [UserPortalController::class, 'index'])->name('user.portal');
    Route::post('/portal/scan-mobile', [UserPortalController::class, 'scanWasteFromMobile'])->name('user.scan-mobile');
});

// Dashboard Admin (Full Control: Servo, Rules, Manajemen Stasiun)
Route::middleware(['auth', EnsureUserIsAdmin::class])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('servos', ServoController::class);
    Route::get('/auto-sort', [\App\Http\Controllers\Api\AutoSortController::class, 'index'])->name('auto.sort');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
