<?php

namespace App\Providers;

use App\Repositories\EmpleadoRepository;
use App\Repositories\impl\EmpleadoRepositoryImpl;
use App\Services\EmpleadoService;
use App\Services\impl\EmpleadoServiceImpl;
use Illuminate\Support\ServiceProvider;

class EmpleadoServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Servicios de Empleado
        $this->app->bind(EmpleadoService::class, EmpleadoServiceImpl::class);
        // Repositorios de Empleado
        $this->app->bind(EmpleadoRepository::class, EmpleadoRepositoryImpl::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
