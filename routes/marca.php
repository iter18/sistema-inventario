<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MarcaController;

Route::middleware(['auth:api', 'role:admin'])->group(function () {
    Route::post('/crear', [MarcaController::class, 'crear']);
    Route::get('/lista', [MarcaController::class, 'listar']);
    Route::put('/actualizar/{id}', [MarcaController::class, 'actualizar']);
    Route::delete('/eliminar/{id}', [MarcaController::class, 'eliminar']);
});
