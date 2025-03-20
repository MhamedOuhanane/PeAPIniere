<?php

use App\Http\Controllers\Auth\AuthUserController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('register', [RegisterController::class, 'register']);
Route::post('login', [AuthUserController::class, 'login']);
