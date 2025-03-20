<?php

use App\Http\Controllers\PlanteController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->group(function(){
    Route::apiResource('plante', PlanteController::class);
});
