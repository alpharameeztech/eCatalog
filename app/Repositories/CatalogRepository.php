<?php

namespace App\Repositories;

use App\Catalog;
use App\Repositories\Interfaces\CatalogRepositoryInterface;

class CatalogRepository implements CatalogRepositoryInterface
{
    public function all()
    {
        return Catalog::where('status', 1)->get();
    }

    public function latest($limit = 4)
    {
        return Catalog::where('status', 1)
                    ->latest()
                    ->limit($limit)
                    ->where('status',1)
                    ->get();
    }
}