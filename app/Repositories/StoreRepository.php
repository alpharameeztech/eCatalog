<?php

namespace App\Repositories;

use App\Store;
use App\Repositories\Interfaces\StoreRepositoryInterface;

class StoreRepository implements StoreRepositoryInterface
{
    public function all()
    {
        return Store::all();
    }
}