<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicLandingController;
use App\Http\Controllers\PublicMonitorController;
use App\Http\Controllers\Auth\GoogleAuthController;
use App\Http\Controllers\UserPortalController;
use App\Http\Controllers\ServoController;
use App\Http\Middleware\EnsureUserIsAdmin;

// ==============================================================
// 1. PUBLIC-FIRST EXPERIENCE (SMART BIN — UIN Bandung)
// Akses terbuka untuk publik tanpa wajib login
// ==============================================================
Route::get('/', [PublicLandingController::class, 'index'])->name('home');
Route::get('/locations', [PublicLandingController::class, 'locations'])->name('public.locations');
Route::get('/peta', [PublicLandingController::class, 'locations'])->name('public.locations.alias');
Route::get('/education', [PublicLandingController::class, 'education'])->name('public.education');
Route::get('/edukasi', [PublicLandingController::class, 'education'])->name('public.education.alias');
Route::get('/bins/{id}', [PublicLandingController::class, 'binDetail'])->name('public.bin-detail');

// Tampilan Monitor IoT Diagnostik (Kamera & Status Sensor Stasiun)
Route::get('/monitor', [PublicMonitorController::class, 'index'])->name('public.monitor');
Route::get('/public-monitor', [PublicMonitorController::class, 'index'])->name('public.monitor.alias');
Route::get('/api/public-summary', [PublicMonitorController::class, 'getSummary'])->name('api.public-summary');

// Autentikasi Google OAuth
Route::get('/auth/google', [GoogleAuthController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [GoogleAuthController::class, 'handleGoogleCallback'])->name('auth.google.callback');

// Portal Pengguna (Google User: Poin, QR Code Deposit, Scan HP, Edukasi)
Route::middleware('auth')->group(function () {
    Route::get('/portal', [UserPortalController::class, 'index'])->name('user.portal');
    Route::post('/portal/scan-mobile', [UserPortalController::class, 'scanWasteFromMobile'])->name('user.scan-mobile');
});

// Dashboard Admin (Full Control: Servo, Rules, Manajemen Stasiun, Email Alert)
Route::middleware(['auth', EnsureUserIsAdmin::class])->group(function () {
    Route::get('/dashboard', function () {
        $smartBins = \App\Models\SmartBin::all();
        return view('dashboard', compact('smartBins'));
    })->name('dashboard');

    // Trigger Notifikasi Email Sampah Penuh via Klik di Admin
    Route::post('/admin/stations/{id}/alert-email', [\App\Http\Controllers\Admin\BinAlertController::class, 'triggerStationAlert'])->name('admin.stations.alert');
    Route::post('/admin/sensors/alert-live', [\App\Http\Controllers\Admin\BinAlertController::class, 'triggerLiveSensorAlert'])->name('admin.sensors.alert-live');

    Route::resource('servos', ServoController::class);
    Route::get('/auto-sort', [\App\Http\Controllers\Api\AutoSortController::class, 'index'])->name('auto.sort');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
