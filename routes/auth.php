<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;


Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::get('/forgotpassword', [ForgotPasswordController::class, 'index'])->name('forgotpassword');
Route::get("logout", [LoginController::class, 'logout']) -> name('logout');

// Auth POST
Route::post('register',[RegisterController::class,'store'])->name('post_register');
Route::post('login',[LoginController::class,'login'])->name('post_login');
Route::post('forgotpassword',[ForgotPasswordController::class, 'SendLink'])->name('forgotpasswordsendlink');

// Verify Email
Route::get('verify-email/{user_token}',[RegisterController::class,'verify'])->name('verifyLink');
// Verify Reset Password
Route::get('new-password/{userToken}/timestamp/{timestamp}', [ForgotPasswordController::class,'CheckLink']) -> name('CheckLink');
Route::post('new-password/{userToken}/timestamp/{timestamp}', [ForgotPasswordController::class,'newpassword']) -> name('newpassword');
