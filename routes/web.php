<?php

use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [SubmissionController::class, 'list']);

Route::get('/create', [SubmissionController::class, 'create']);
Route::post('/create', [SubmissionController::class, 'store']);

Route::get('/audio/{post}', [SubmissionController::class, 'edit']);
Route::post('/audio/{post}', [SubmissionController::class, 'update']);

Route::delete('/audio/{post}', [SubmissionController::class, 'destroy']);

Route::get('/login', [UserController::class, 'viewLogin'])->name('login');
Route::post('/login', [UserController::class, 'login']);
Route::get('/logout', [UserController::class, 'logout']);

Route::get('/dashboard', [DashboardController::class, 'view'])->middleware('auth');
