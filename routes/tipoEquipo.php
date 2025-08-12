<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TipoEquipoController;

Route::middleware(['auth:api', 'role:admin'])->group(function () {
    Route::post('/crear', [TipoEquipoController::class, 'crear']);
    Route::get('/lista', [TipoEquipoController::class, 'listar']);
    Route::put('/actualizar/{id}', [TipoEquipoController::class, 'actualizar']);
    Route::delete('/eliminar/{id}', [TipoEquipoController::class, 'eliminar']);
});
