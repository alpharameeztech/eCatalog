<?php

namespace App\Providers;

use App\Repositories\StoreRepository;
use App\Repositories\CatalogRepository;
use App\Repositories\Interfaces\StoreRepositoryInterface;
use App\Repositories\Interfaces\CatalogRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            StoreRepositoryInterface::class, 
            StoreRepository::class
        );

        $this->app->bind(
            CatalogRepositoryInterface::class, 
            CatalogRepository::class
        );
    }
}