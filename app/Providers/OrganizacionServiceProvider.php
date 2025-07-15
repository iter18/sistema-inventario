<?php

namespace App\Providers;

use App\Models\Organizacion;
use App\Services\OrganizacionService;
use Illuminate\Support\ServiceProvider;
use App\Repositories\OrganizacionRepository;
use App\Services\impl\OrganizacionServiceImpl;
use App\Repositories\impl\OrganizacionRepositoryImpl;

class OrganizacionServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //Servicios de Organizacion
        $this->app->bind(OrganizacionService::class,OrganizacionServiceImpl::class);

        //Repositorios de Organizacion
        $this->app->bind(OrganizacionRepository::class, OrganizacionRepositoryImpl::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
