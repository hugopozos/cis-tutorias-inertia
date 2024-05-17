<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ContractServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        /**
         * Bind repositories
         */
        $this->app->bind(
            \App\Contracts\Repositories\UniversityCareerRepositoryInterface::class,
            \App\Repositories\UniversityCareerRepository::class
        );
        $this->app->bind(
            \App\Contracts\Repositories\UserRepositoryInterface::class,
            \App\Repositories\UserRepository::class
        );
        $this->app->bind(
            \App\Contracts\Repositories\RoleRepositoryInterface::class,
            \App\Repositories\RoleRepository::class
        );

        /**
         * Bind services
         */
        $this->app->bind(
            \App\Contracts\Services\UserServiceInterface::class,
            \App\Services\UserService::class
        );
    }

}
