<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrganizacionController;

// Todas las rutas en este archivo ya están prefijadas con '/organizaciones' desde api.php

// Rutas protegidas que requieren autenticación y roles específicos
Route::middleware(['auth:api', 'role:admin'])->group(function () {

    // POST /api/organizaciones -> Crea una nueva organización (solo para admins)
    // Route::post('/', [OrganizacionController::class, 'crear']);

    // GET /api/organizaciones/{id} -> Muestra una organización específica
    // Route::get('/{organizacion}', [OrganizacionController::class, 'mostrar']);

    // PUT /api/organizaciones/{id} -> Actualiza una organización
    // Route::put('/{organizacion}', [OrganizacionController::class, 'actualizar']);

    // DELETE /api/organizaciones/{id} -> Elimina una organización
    // Route::delete('/{organizacion}', [OrganizacionController::class, 'eliminar']);

    // Puedes mantener tu ruta de prueba si lo deseas
    Route::get('/ping', fn() => response()->json(['message' => 'pong']));
 });
  Route::get('/lista', [OrganizacionController::class, 'listar']);
