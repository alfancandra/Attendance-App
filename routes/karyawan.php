<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Karyawan\DashboardController;
use App\Http\Controllers\Karyawan\UserReportController;
use App\Http\Controllers\Karyawan\UserProfileController;

// User
Route::group(['middleware' => ["UserKaryawan", 'prevent-back'], 'as' => 'usr.'], function() {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/report', [UserReportController::class, 'index'])->name('report');
    Route::get('/profile', [UserProfileController::class, 'index'])->name('profile');
});

