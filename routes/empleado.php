<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpleadoController;

Route::middleware(['auth:api', 'role:admin'])->group(function () {
    Route::post('/crear', [EmpleadoController::class, 'crear']);
    Route::get('/lista', [EmpleadoController::class, 'listar']);
    Route::put('/actualizar/{id}', [EmpleadoController::class, 'actualizar']);
    Route::delete('/eliminar/:id', [EmpleadoController::class, 'eliminar']);
});
