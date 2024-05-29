<?php

use App\Http\Controllers\AudioController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AudioController::class, 'list']);

Route::get('/create', [AudioController::class, 'create']);
Route::post('/create', [AudioController::class, 'store']);

Route::get('/audio/{post}', [AudioController::class, 'edit']);
Route::post('/audio/{post}', [AudioController::class, 'update']);

Route::delete('/audio/{post}', [AudioController::class, 'destroy']);

Route::get('/login', [UserController::class, 'loginForm'])->name('login');
Route::post('/login', [UserController::class, 'loginProcess']);
Route::get('/logout', [UserController::class, 'logoutProcess']);

Route::get('/dashboard', [DashboardController::class, 'display'])->middleware('auth');
