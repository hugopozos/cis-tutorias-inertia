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

        /**
         * Bind services
         */
    }

}
