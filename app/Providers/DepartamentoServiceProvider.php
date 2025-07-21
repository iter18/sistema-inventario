<?php

namespace App\Providers;

use App\Services\DepartamentoService;
use Illuminate\Support\ServiceProvider;
use App\Repositories\DepartamentoRepository;
use App\Services\impl\DepartamentoServiceImpl;
use App\Repositories\impl\DepartamentoRepositoryImpl;

class DepartamentoServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //Servicios de Organizacion
        $this->app->bind(DepartamentoService::class,DepartamentoServiceImpl::class);

        //Repositorios de Organizacion
        $this->app->bind(DepartamentoRepository::class, DepartamentoRepositoryImpl::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
