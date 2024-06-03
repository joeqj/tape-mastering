<?php

use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\UserActivityController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [SubmissionController::class, 'list']);



Route::get('/audio/{post}', [SubmissionController::class, 'edit']);
Route::post('/audio/{post}', [SubmissionController::class, 'update']);

Route::delete('/audio/{post}', [SubmissionController::class, 'destroy']);

Route::get('/login', [UserController::class, 'viewLogin'])->name('login');
Route::post('/login', [UserController::class, 'login']);
Route::get('/logout', [UserController::class, 'logout']);

Route::get('/dashboard', [DashboardController::class, 'view'])->middleware('auth');

Route::post('/upload', [SubmissionController::class, 'create']);
Route::post('/store', [SubmissionController::class, 'store']);

Route::get('/error', [SubmissionController::class, 'error'])->name('error');
Route::get('/create-checkout-session', [PaymentController::class, 'create'])->name('create-checkout-session');
Route::get('/payment/success/{id}', [PaymentController::class, 'success']);
Route::get('/payment/cancel/{id}', [PaymentController::class, 'cancel']);

Route::post('/cancel-upload', [UserActivityController::class, 'userLeaving']);
