<?php

use App\Http\Controllers\SessionController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [TaskController::class, 'index']);
Route::resource('tasks', TaskController::class);

Route::resource('users', UserController::class)
    ->only('create', 'store');

Route::resource('sessions', SessionController::class)
    ->only('create', 'store', 'destroy');
