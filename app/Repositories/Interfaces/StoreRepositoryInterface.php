<?php

namespace App\Repositories\Interfaces;

use App\Store;

interface StoreRepositoryInterface
{
    public function all();

    public function availableInCities(Store $store);

    public function catalogs(Store $store);
}