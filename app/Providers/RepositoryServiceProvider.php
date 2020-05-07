<?php

namespace App\Providers;

use App\Repositories\StoreRepository;
use App\Repositories\Interfaces\StoreRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            StoreRepositoryInterface::class, 
            StoreRepository::class
        );
    }
}