<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [TaskController::class, 'index']);
Route::resource('tasks', TaskController::class);

Route::resource('users', UserController::class)
    ->only('create', 'store');
