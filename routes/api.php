<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;




Route::prefix('auth')->group(base_path('routes/authorizacion.php'));

Route::prefix('organizaciones')->group(base_path('routes/organizacion.php'));
