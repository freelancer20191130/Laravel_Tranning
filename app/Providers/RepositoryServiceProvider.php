<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * interface
 */

use App\Repositories\M0010RepositoryInterface;
use App\Repositories\LibraryRepositoryInterface;
use App\Repositories\PopupRepositoryInterface;
use App\Repositories\sS0020RepositoryInterface;
use App\Repositories\M0020RepositoryInterface;
use App\Repositories\sM0100RepositoryInterface;
use App\Repositories\sS0030RepositoryInterface;
use App\Repositories\M0030RepositoryInterface;
use App\Repositories\M0050RepositoryInterface;
use App\Repositories\M0040RepositoryInterface;
use App\Repositories\M0060RepositoryInterface;
use App\Repositories\M0080RepositoryInterface;
/**
 * sqlserver
 */

use App\Repositories\sqlserver\M0010Repository;
use App\Repositories\sqlserver\LibraryRepository;
use App\Repositories\sqlserver\PopupRepository;
use App\Repositories\sqlserver\sS0020Repository;
use App\Repositories\sqlserver\M0020Repository;
use App\Repositories\sqlserver\sM0100Repository;
use App\Repositories\sqlserver\sS0030Repository;
use App\Repositories\sqlserver\M0030Repository;
use App\Repositories\sqlserver\M0050Repository;

use App\Repositories\sqlserver\M0040Repository;
use App\Repositories\sqlserver\M0060Repository;
use App\Repositories\sqlserver\M0080Repository;

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
        $this->app->bind(M0010RepositoryInterface::class, M0010Repository::class);
        $this->app->bind(LibraryRepositoryInterface::class, LibraryRepository::class);
        $this->app->bind(sS0020RepositoryInterface::class, sS0020Repository::class);
        $this->app->bind(M0020RepositoryInterface::class, M0020Repository::class);
        $this->app->bind(sM0100RepositoryInterface::class, sM0100Repository::class);
        $this->app->bind(sS0030RepositoryInterface::class, sS0030Repository::class);
        $this->app->bind(PopupRepositoryInterface::class, PopupRepository::class);
        $this->app->bind(M0030RepositoryInterface::class, M0030Repository::class);
        $this->app->bind(M0050RepositoryInterface::class, M0050Repository::class);
        
        $this->app->bind(M0040RepositoryInterface::class, M0040Repository::class);
        $this->app->bind(M0060RepositoryInterface::class, M0060Repository::class);
        $this->app->bind(M0080RepositoryInterface::class, M0080Repository::class);
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
