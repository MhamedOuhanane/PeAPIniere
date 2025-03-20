<?php

use App\Http\Controllers\Auth\AuthUserController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

Route::post('register', [RegisterController::class, 'register']);
Route::post('login', [AuthUserController::class, 'login']);
Route::get('logout', [AuthUserController::class, 'logout'])->middleware('auth:api');