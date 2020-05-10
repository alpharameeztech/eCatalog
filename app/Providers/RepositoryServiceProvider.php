<?php

namespace App\Providers;

use App\Repositories\StoreRepository;
use App\Repositories\CatalogRepository;
use App\Repositories\BranchRepository;
use App\Repositories\Interfaces\StoreRepositoryInterface;
use App\Repositories\Interfaces\CatalogRepositoryInterface;
use App\Repositories\Interfaces\BranchRepositoryInterface;
use App\Repositories\Interfaces\TermRepositoryInterface;
use App\Repositories\TermRepository;
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

        $this->app->bind(
            BranchRepositoryInterface::class, 
            BranchRepository::class
        );

        $this->app->bind(
            TermRepositoryInterface::class, 
            TermRepository::class
        );
    }
}