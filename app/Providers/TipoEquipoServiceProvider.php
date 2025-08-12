<?php

namespace App\Providers;

use App\Services\TipoEquipoService;
use Illuminate\Support\ServiceProvider;
use App\Repositories\TipoEquipoRepository;
use App\Services\impl\TipoEquipoServiceImpl;
use App\Repositories\impl\TipoEquipoRepositoryImpl;

class TipoEquipoServiceProvider extends ServiceProvider



{
    /**
     * Register services.
     */
    public function register(): void
    {
        //Servicios de TipoEquipo
        $this->app->bind(TipoEquipoService::class, TipoEquipoServiceImpl::class);

        //Repositorios de TipoEquipo
        $this->app->bind(TipoEquipoRepository::class, TipoEquipoRepositoryImpl::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
