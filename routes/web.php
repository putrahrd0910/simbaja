<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ResetPasswordController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\RupController;


Route::get('/', function () {
    return view('login');
});

//LOGIN
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('actionlogin', [LoginController::class, 'actionlogin'])->name('actionlogin');

//HOME
Route::get('home', [HomeController::class, 'index'])->name('home')->middleware('auth');
// Route::get('home/profile', [HomeController::class, 'profile'])->name('home.profile')->middleware('auth');

// PROFILE
Route::get('home/profile', [ProfileController::class,'profile'])->name('home.profile')->middleware('auth');
Route::put('home/profile/update', [ProfileController::class, 'update'])->name('profile.update')->middleware('auth');

//USERS
Route::resource('users', UserController::class)->middleware('auth');

// Route tambahan untuk mengaktifkan user
Route::post('/users/{id}/nonaktifkan', [UserController::class, 'nonaktifkan'])->name('users.nonaktifkan');
Route::post('/users/{id}/aktifkan', [UserController::class, 'aktifkan'])->name('users.aktifkan');

//LOGOUT
Route::get('actionlogout', [LoginController::class, 'actionlogout'])->name('actionlogout')->middleware('auth');

//REGISTER
Route::get('register', [RegisterController::class, 'register'])->name('register');
Route::post('register/action', [RegisterController::class, 'actionregister'])->name('actionregister');

//VERIFY GMAIL
Route::get('register/verify/{verify_key}', [RegisterController::class, 'verify'])->name('verify');

// PASSWORD
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/update_password', [ForgotPasswordController::class, 'reset'])->name('password.update');

// Route untuk menampilkan form ganti password
Route::get('password/change', [ChangePasswordController::class, 'showChangePasswordForm'])->middleware('auth')->name('password.change');
// Route untuk submit form ganti password
Route::post('password/change', [ChangePasswordController::class, 'changePassword'])->middleware('auth')->name('password.update');

// Route::get('api-data', [RupController::class, 'getData'])->name('api-data')->middleware('auth');

Route::get('/rup', [RupController::class, 'getData'])->name('rup')->middleware('auth');
Route::get('/rup/refresh', [RupController::class, 'refreshData'])->name('refreshData')->middleware('auth');