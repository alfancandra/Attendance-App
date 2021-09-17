<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetPasswordController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Auth GET
Route::get('/', [LoginController::class, 'index'])->name('login');
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::get('/forgotpassword', [ForgotPasswordController::class, 'index'])->name('forgotpassword');
Route::get('/resetpassword', [ResetPasswordController::class, 'index'])->name('resetpassword');

// Auth POST
Route::post('register',[RegisterController::class,'store'])->name('post_register');
Route::post('login',[LoginController::class,'login'])->name('post_login');

// Verify Email
Route::get('verify-email/{user_token}',[RegisterController::class,'verify'])->name('verifyLink');

// User
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Admin