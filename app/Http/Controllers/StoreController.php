<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\AdvertisementRepositoryInterface;
use App\Repositories\Interfaces\CatalogRepositoryInterface;
use App\Repositories\Interfaces\CityRepositoryInterface;
use App\Repositories\Interfaces\CountryRepositoryInterface;
use App\Repositories\Interfaces\SocialRepositoryInterface;
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

    protected $socialRepository;

    public function __construct(
        CatalogRepositoryInterface $catalogRepository,
        StoreRepositoryInterface $storeRepository,
        CityRepositoryInterface $cityRepository,
        CountryRepositoryInterface $countryRepository,
        TagRepositoryInterface $tagRepository,
        AdvertisementRepositoryInterface $advertisementRepository,
        SocialRepositoryInterface $socialRepository

    )
    {
        $this->catalogRepository = $catalogRepository;
        $this->storeRepository = $storeRepository;
        $this->cityRepository = $cityRepository;
        $this->countryRepository = $countryRepository;
        $this->tagRepository = $tagRepository;
        $this->advertisementRepository = $advertisementRepository;
        $this->socialRepository = $socialRepository;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $this->setLocale($request);

        return view('pages.store.index',[
            'stores' => $this->storeRepository->all(),
            'recent_stores' => $this->storeRepository->get($limit=8),
            'recent_cities' => $this->cityRepository->get($limit=8),
            'recent_countries' => $this->countryRepository->get($limit=5),
            'all_countries' => $this->countryRepository->all(),
            'tags' => $this->tagRepository->all(),
            'recent_stores' => $this->storeRepository->get($limit=8),
            'social'=> $this->socialRepository->all(),
            'all_cites' => $this->cityRepository->all(),
            'all_stores_page_long_ad_1' => $this->advertisementRepository->get('all-stores-page-long-ad-1'),
            'all_stores_page_long_ad_2' => $this->advertisementRepository->get('all-stores-page-long-ad-2'),
            'all_stores_page_long_ad_3' => $this->advertisementRepository->get('all-stores-page-long-ad-3'),

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
    public function show($lang, Request $request, Store $store)
    {

        $this->setLocale($request);

        return view('pages.store.show',[
            'store' => $store,
            'in_cities' =>  $this->storeRepository->availableInCities($store),
            'recent_stores' => $this->storeRepository->get($limit=8),
            'recent_cities' => $this->cityRepository->get($limit=8),
            'recent_countries' => $this->countryRepository->get($limit=5),
            'all_countries' => $this->countryRepository->all(),
            'page_description' => $store->page,
            'store_catalogs' => $store->catalogs,
            'store_left_sections' => $this->advertisementRepository->get('store-left-section'),
            'store_right_sections' => $this->advertisementRepository->get('store-right-section'),
            'store_long_ad_1' => $this->advertisementRepository->get('store-long-ad-1'),
            'store_long_ad_2' => $this->advertisementRepository->get('store-long-ad-2'),
            'social'=> $this->socialRepository->all(),
            'all_cites' => $this->cityRepository->all(),

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
