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

Route::get('/login', [UserController::class, 'viewLogin'])->name('login');
Route::post('/login', [UserController::class, 'login']);
Route::get('/logout', [UserController::class, 'logout']);

Route::get('/dashboard', [DashboardController::class, 'view'])->middleware('auth');
