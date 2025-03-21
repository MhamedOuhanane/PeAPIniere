<?php

use App\Http\Controllers\PlanteController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->group(function(){
    Route::get('plante', [PlanteController::class, 'index'])->name('plante.index');
    Route::get('plante/{slug}', [PlanteController::class, 'show'])->name('plante.show');
    Route::post('plante', [PlanteController::class, 'store'])->name('plante.store');
    Route::put('plante/{slug}', [PlanteController::class, 'update'])->name('plante.update');
    Route::delete('plante/{slug}', [PlanteController::class, 'destroy'])->name('plante.destroy');
});


require __DIR__.'/auth.php';
