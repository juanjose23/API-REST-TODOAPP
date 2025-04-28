<?php

namespace App\Providers;

use App\Interfaces\AuthInterface;
use App\Repository\AuthRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
        $this->app->bind(AuthInterface::class, AuthRepository::class);
    }

    /**
     * Bootstrap srvices.
     */
    public function boot(): void
    {
        //
    }
}
