<?php

namespace App\Providers;

use App\Models\Categorie;
use App\Models\Plante;
use App\Models\User;
use App\Policies\CategoriePolicy;
use App\Policies\PlantePolicy;
use App\Policies\UserPolicy;
use App\RepositorieInterface\CategorieRepositoryInterface;
use App\RepositorieInterface\CommandeRepositoryInterface;
use App\RepositorieInterface\PhotoRepositoryInterface;
use App\RepositorieInterface\PlanteRepositoryInterface;
use App\RepositorieInterface\RoleRepositoryInterface;
use App\RepositorieInterface\UserRepositoryInterface;
use App\Repositories\CategorieRepository;
use App\Repositories\CommandeRepository;
use App\Repositories\PhotoRepository;
use App\Repositories\PlanteRepository;
use App\Repositories\RoleRepository;
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
        $this->app->bind(RoleRepositoryInterface::class, RoleRepository::class);
        $this->app->bind(CategorieRepositoryInterface::class, CategorieRepository::class);
        $this->app->bind(PhotoRepositoryInterface::class, PhotoRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
