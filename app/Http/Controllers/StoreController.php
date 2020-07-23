<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\AdvertisementRepositoryInterface;
use App\Repositories\Interfaces\CatalogRepositoryInterface;
use App\Repositories\Interfaces\CityRepositoryInterface;
use App\Repositories\Interfaces\CountryRepositoryInterface;
use App\Repositories\Interfaces\StoreRepositoryInterface;
use App\Repositories\Interfaces\TagRepositoryInterface;
use App\Store;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    protected $storeRepository;

    protected $catalogRepository;

    private $cityRepository;

    private $countryRepository;

    private $tagRepository;

    private $advertisementRepository;

    public function __construct(
        CatalogRepositoryInterface $catalogRepository,
        StoreRepositoryInterface $storeRepository,
        CityRepositoryInterface $cityRepository,
        CountryRepositoryInterface $countryRepository,
        TagRepositoryInterface $tagRepository,
        AdvertisementRepositoryInterface $advertisementRepository
    )
    {
        $this->catalogRepository = $catalogRepository;
        $this->storeRepository = $storeRepository;
        $this->cityRepository = $cityRepository;
        $this->countryRepository = $countryRepository;
        $this->tagRepository = $tagRepository;
        $this->advertisementRepository = $advertisementRepository;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.store.index',[
            'stores' => $this->storeRepository->all(),
            'recent_stores' => $this->storeRepository->get($limit=8),
            'recent_cities' => $this->cityRepository->get($limit=8),
            'recent_countries' => $this->countryRepository->get($limit=5),
            'tags' => $this->tagRepository->all(),
            'recent_stores' => $this->storeRepository->get($limit=8),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Store $store)
    {

        return view('pages.store.show',[
            'store' => $store,
            'in_cities' =>  $this->storeRepository->availableInCities($store),
            'recent_stores' => $this->storeRepository->get($limit=8),
            'recent_cities' => $this->cityRepository->get($limit=8),
            'recent_countries' => $this->countryRepository->get($limit=5),
            'page_description' => $store->page,
            'store_catalogs' => $store->catalogs,
            'store_left_sections' => $this->advertisementRepository->get('store-left-section'),
            'store_right_sections' => $this->advertisementRepository->get('store-right-section')
        ]);
    }

    /**
     * Show the catalogs of a store
     */
    public function showCatalogs(Store $store){

        return view('pages.store.show_catalogs',[
            'store' => $store,
            'catalogs' =>  $this->storeRepository->catalogs($store),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
