<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminEmployeeController;
use App\Http\Controllers\Admin\AdminReportController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\AdminWorkingHoursController;
use App\Http\Controllers\Admin\AdminOfficeController;

// Admin
Route::group(['middleware' => ["UserAdmin", 'prevent-back'], 'as' => 'adm.'], function() {
    // Employee Page
    Route::get('/employee', [AdminEmployeeController::class, 'index'])->name('employee');
    Route::get('/employee/acc/{id}',[AdminEmployeeController::class,'accept'])->name('accemployee');
    Route::get('/employee/reject/{id}',[AdminEmployeeController::class,'reject'])->name('rejectemployee');
    Route::get('/employee/destroy/{id}',[AdminEmployeeController::class,'destroy'])->name('destroyemployee');

    // Report Page
    Route::get('/adminreport', [AdminReportController::class, 'index'])->name('adminreport');

    // Admin Profile Page
    Route::get('/adminprofile', [AdminProfileController::class, 'index'])->name('adminprofile');
    Route::post('adminprofile',[AdminProfileController::class,'updateadminprofile'])->name('updateadminprofile');

    // Working Hours Page
    Route::get('/workinghours', [AdminWorkingHoursController::class, 'index'])->name('workinghours');
    Route::get('/workinghours/activate/{id}',[AdminWorkingHoursController::class,'activate'])->name('activatehours');
    Route::get('/workinghours/deactivate/{id}',[AdminWorkingHoursController::class,'deactivate'])->name('deactivatehours');
    Route::get('/addworkinghours', [AdminWorkingHoursController::class, 'addworkinghours'])->name('addworkinghours');
    Route::post('addworkinghours',[AdminWorkingHoursController::class, 'store'])->name('post_hours');
    Route::get('/workinghours/destroy/{id}',[AdminWorkingHoursController::class,'destroy'])->name('destroyworkinghours');

    Route::get('/workinghours/edit/{id}',[AdminWorkingHoursController::class,'edit'])->name('editworkinghours');
    Route::post('/workinghours/edit/{id}',[AdminWorkingHoursController::class,'update'])->name('updateworkinghours');

    // Office Profile Page
    Route::get('/officeprofile', [AdminOfficeController::class, 'edit'])->name('officeprofile');
    Route::post('/officeprofile/edit/{id}', [AdminOfficeController::class, 'update'])->name('updateofficeprofile');
});