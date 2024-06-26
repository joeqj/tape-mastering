<?php

use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\UserActivityController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'pages.home');
Route::view('/about', 'pages.about');

Route::get('/admin', [SubmissionController::class, 'list']);



Route::get('/audio/{post}', [SubmissionController::class, 'edit']);
Route::post('/audio/{post}', [SubmissionController::class, 'update']);

Route::delete('/audio/{post}', [SubmissionController::class, 'destroy']);

Route::get('/login', [UserController::class, 'showLogin'])->name('login');
Route::post('/login', [UserController::class, 'login']);
Route::get('/logout', [UserController::class, 'logout']);
Route::view('/signup', 'user.signup')->name('signup');
Route::post('/signup', [UserController::class, 'signup']);


Route::get('/dashboard', [DashboardController::class, 'view'])->middleware('auth')->name('dashboard');

Route::post('/upload', [SubmissionController::class, 'create'])->middleware('auth');
Route::get('/upload', [SubmissionController::class, 'create'])->middleware('auth');
Route::post('/store', [SubmissionController::class, 'store']);

Route::get('/error', [SubmissionController::class, 'error'])->middleware('auth')->name('error');
Route::get('/create-checkout-session', [PaymentController::class, 'create'])->middleware('auth')->name('create-checkout-session');
Route::post('/check-coupon', [PaymentController::class, 'checkCoupon'])->middleware('auth')->name('check-coupon');
Route::get('/payment/success/{id}', [PaymentController::class, 'success'])->middleware('auth');
Route::get('/payment/cancel/{id}', [PaymentController::class, 'cancel'])->middleware('auth');

Route::post('/cancel-upload', [UserActivityController::class, 'userLeaving']);
