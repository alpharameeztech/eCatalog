<?php

namespace App\Repositories;

use App\Store;
use App\Repositories\Interfaces\StoreRepositoryInterface;
use App\City;
use App\Country;
use Illuminate\Support\Arr;
use App\Support\Collection;

class StoreRepository implements StoreRepositoryInterface
{
    public function all()
    {
        return Store::where('status', 1)->get();
    }

    public function availableInCities(Store $store){
        
        
        $branches = $store->branches;
       
        $branches = collect($branches);
        
        $city_ids = $branches->pluck('city_id');
        
        $unique_city_ids = $city_ids->unique();

        $unique_city_ids_array = Arr::flatten($unique_city_ids);

        $cities = [];
        foreach($unique_city_ids_array  as $city_id){
            $city = City::where('id', $city_id)->get();
            $cities = Arr::prepend($cities, $city);
        }
        return Arr::flatten($cities);
       
    }
    /**
     * pass all the store catalogs
     * that have status true
    */
    public function catalogs(Store $store){

        $catalogs = $store->catalogs->where('status',1)->paginate(16);

        return $catalogs;
    }
}