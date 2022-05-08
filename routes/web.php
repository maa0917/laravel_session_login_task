<?php

use App\Http\Controllers\SessionController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [TaskController::class, 'index']);
Route::resource('tasks', TaskController::class)
    ->middleware('auth');

Route::resource('users', UserController::class)
    ->only('store', 'create')
    ->middleware('guest');
Route::resource('users', UserController::class)
    ->only('show', 'update', 'destroy', 'edit')
    ->middleware('auth')
    ->middleware('current.user');

Route::delete('sessions/{session}', [SessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('sessions.destroy');
Route::resource('sessions', SessionController::class)
    ->only('create', 'store')
    ->middleware('guest');
