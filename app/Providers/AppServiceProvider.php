<?php

namespace App\Providers;

use App\RepositorieInterface\planteRepositoryInterface;
use App\RepositorieInterface\UserRepositoryInterface;
use App\Repositories\planteRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(planteRepositoryInterface::class, planteRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
