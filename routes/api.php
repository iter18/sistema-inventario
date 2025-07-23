<?php

use Illuminate\Support\Facades\Route;




Route::prefix('auth')->group(base_path('routes/authorizacion.php'));

Route::prefix('organizaciones')->group(base_path('routes/organizacion.php'));
Route::prefix('departamentos')->group(base_path('routes/departamento.php'));
Route::prefix('empleados')->group(base_path('routes/empleado.php'));
