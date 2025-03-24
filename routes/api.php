<?php

use App\Http\Controllers\CategorieController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\PlanteController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->group(function(){
    Route::apiResource('plante', PlanteController::class);
    Route::apiResource('commande', CommandeController::class);
    Route::apiResource('categorie', CategorieController::class);
    Route::put('user/{user}', [UserController::class, 'update']);
    Route::post('photo', [PhotoController::class, 'store']);

    Route::middleware('role:admine')->group(function() {
        Route::get('statistique', [DashboardAdminController::class, 'index']);
    });
});


require __DIR__.'/auth.php';
