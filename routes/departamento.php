<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepartamentoController;

Route::middleware(['auth:api', 'role:admin'])->group(function () {
    // Aquí puedes agregar rutas protegidas para el controlador DepartamentoController
    // Por ejemplo, si decides implementar métodos para crear, actualizar o eliminar departamentos.

    Route::get('/listaPorOrganizacion', [DepartamentoController::class, 'listarPorOrganizacion']);
});
