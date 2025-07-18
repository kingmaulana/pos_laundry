<?php

namespace App\Providers;

use App\Interfaces\PaketRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Repositories\PaketRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(PaketRepositoryInterface::class, PaketRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
