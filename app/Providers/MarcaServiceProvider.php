<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class MarcaServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Marca Service
        $this->app->bind(\App\Services\MarcaService::class, \App\Services\impl\MarcaServiceImpl::class);

        // Marca Repository
        $this->app->bind(\App\Repositories\MarcaRepository::class, \App\Repositories\impl\MarcaRepositoryImpl::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
