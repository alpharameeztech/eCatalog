<?php

namespace App\Repositories\Interfaces;

use App\Catalog;

interface CatalogRepositoryInterface
{
    public function all();

    public function latest($limit = 4);

    public function inCities(Catalog $catalog);

    public function viewed(Catalog $catalog);

}