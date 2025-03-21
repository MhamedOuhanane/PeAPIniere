<?php

namespace App\Providers;

use App\RepositorieInterface\CommandeRepositoryInterface;
use App\RepositorieInterface\PlanteRepositoryInterface;
use App\RepositorieInterface\UserRepositoryInterface;
use App\Repositories\CommandeRepository;
use App\Repositories\PlanteRepository;
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
        $this->app->bind(PlanteRepositoryInterface::class, PlanteRepository::class);
        $this->app->bind(CommandeRepositoryInterface::class, CommandeRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
