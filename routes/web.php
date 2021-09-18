<?php

use App\Http\Controllers\AdminEmployeeController;
use App\Http\Controllers\AdminProfileController;
use App\Http\Controllers\AdminReportController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Error404Controller;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\UserReportController;
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
Route::get('/404', [Error404Controller::class, 'index'])->name('error404');

// Auth POST
Route::post('register',[RegisterController::class,'store'])->name('post_register');
Route::post('login',[LoginController::class,'login'])->name('post_login');

// Verify Email
Route::get('verify-email/{user_token}',[RegisterController::class,'verify'])->name('verifyLink');

// User
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/report', [UserReportController::class, 'index'])->name('report');
Route::get('/profile', [UserProfileController::class, 'index'])->name('profile');

// Admin
Route::get('/employee', [AdminEmployeeController::class, 'index'])->name('employee');
Route::get('/adminreport', [AdminReportController::class, 'index'])->name('adminreport');
Route::get('/adminprofile', [AdminProfileController::class, 'index'])->name('adminprofile');
