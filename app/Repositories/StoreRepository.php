<?php

namespace App\Repositories;

use App\Catalog;
use App\Store;
use App\Repositories\Interfaces\StoreRepositoryInterface;
use App\City;
use App\Country;
use App\Tag;
use Illuminate\Support\Arr;
use App\Support\Collection;

class StoreRepository implements StoreRepositoryInterface
{
    public function all()
    {
        $tag = htmlspecialchars(request('tag'));

        if($tag && $tag == 'newest'){
            return Catalog::where('status', 1)
                ->orderBy('created_at', 'desc')
                ->paginate(20);
        }
        else if($tag){
            $tag = Tag::where('slug', $tag)->first();
            return $tag->catalogs->paginate(24);
        }

        return Store::where('status', 1)->paginate(20);
    }

    public function get($limit=5)
    {
        return Store::where('status', 1)
                    ->orderBy('created_at', 'desc')
                    ->limit($limit)
                    ->get();
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
