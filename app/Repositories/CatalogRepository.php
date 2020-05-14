<?php

namespace App\Repositories;

use App\Catalog;
use App\Repositories\Interfaces\CatalogRepositoryInterface;
use App\City;
use Illuminate\Support\Arr;
use App\Support\Collection;

class CatalogRepository implements CatalogRepositoryInterface
{
    public function all()
    {
        return Catalog::where('status', 1)->paginate(16);
    }

    public function latest($limit = 12)
    {
        return Catalog::where('status', 1)
                    ->latest()
                    ->limit($limit)
                    ->where('status',1)
                    ->get();
    }

    public function popular($limit = 12)
    {
        return Catalog::where('status', 1)
                        ->orderBy('total_views', 'desc')
                        ->limit($limit)
                        ->get();
    }

    public function featured()
    {

        return Catalog::where('status', 1)
                        ->where('featured', 1)
                        ->where('featured_expiry_at', '>=', date('Y-m-d'))
                        ->orderBy('created_at', 'desc')
                        ->get();
    }

    public function inCities(Catalog $catalog){

        $branches = $catalog->branches;
       
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
     * The catalog just got viewed
     * by somebody
     * so increment the total_views
     */
    public function viewed(Catalog $catalog)
    {
        $catalog->total_views = ++$catalog->total_views;

        $catalog->save();
    }
}