<?php

namespace App\Providers;

use App\Interfaces\AuthInterface;
use App\Interfaces\TeamInterface;
use App\Models\Team;
use App\Repository\AuthRepository;
use App\Repository\TeamRepository;
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
        $this->app->bind(TeamInterface::class, TeamRepository::class);
    }

    /**
     * Bootstrap srvices.
     */
    public function boot(): void
    {
        //
    }
}
