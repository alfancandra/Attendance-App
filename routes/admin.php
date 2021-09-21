<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminEmployeeController;
use App\Http\Controllers\Admin\AdminReportController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\AdminWorkingHoursController;
use App\Http\Controllers\Admin\AdminAddWorkingHoursController;
use App\Http\Controllers\Admin\AdminOfficeController;

// Admin
Route::group(['middleware' => ["UserAdmin", 'prevent-back'], 'as' => 'adm.'], function() {
    Route::get('/employee', [AdminEmployeeController::class, 'index'])->name('employee');
    Route::get('/adminreport', [AdminReportController::class, 'index'])->name('adminreport');
    Route::get('/adminprofile', [AdminProfileController::class, 'index'])->name('adminprofile');
    Route::get('/workinghours', [AdminWorkingHoursController::class, 'index'])->name('workinghours');
    Route::get('/addworkinghours', [AdminAddWorkingHoursController::class, 'index'])->name('addworkinghours');
    Route::get('/officeprofile', [AdminOfficeController::class, 'index'])->name('officeprofile');
});