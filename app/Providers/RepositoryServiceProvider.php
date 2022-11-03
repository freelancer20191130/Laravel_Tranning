<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * interface
 */

use App\Repositories\UserRepositoryInterface;
/**
 * mysql
 */

use App\Repositories\mysql\UserRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        /**
         * Application repository
         */
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
