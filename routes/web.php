<?php

use App\Http\Controllers\AudioController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AudioController::class, 'list']);

Route::get('/create', [AudioController::class, 'create']);
Route::post('/create', [AudioController::class, 'store']);

Route::get('/audio/{post}', [AudioController::class, 'edit']);
Route::post('/audio/{post}', [AudioController::class, 'update']);

Route::delete('/audio/{post}', [AudioController::class, 'destroy']);
