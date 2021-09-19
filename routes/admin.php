<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminEmployeeController;
use App\Http\Controllers\Admin\AdminReportController;
use App\Http\Controllers\Admin\AdminProfileController;

// Admin
Route::group(['middleware' => ["UserAdmin", 'prevent-back'], 'as' => 'adm.'], function() {
    Route::get('/employee', [AdminEmployeeController::class, 'index'])->name('employee');
    Route::get('/adminreport', [AdminReportController::class, 'index'])->name('adminreport');
    Route::get('/adminprofile', [AdminProfileController::class, 'index'])->name('adminprofile');
});