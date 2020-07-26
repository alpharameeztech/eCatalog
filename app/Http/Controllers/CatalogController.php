<?php

namespace App\Http\Controllers;

use App\Catalog;
use App\Repositories\Interfaces\AdvertisementRepositoryInterface;
use App\Repositories\Interfaces\CatalogRepositoryInterface;
use App\Repositories\Interfaces\SocialRepositoryInterface;
use App\Store;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\StoreRepositoryInterface;
use App\Repositories\Interfaces\CityRepositoryInterface;
use App\Repositories\Interfaces\CountryRepositoryInterface;
use App\Repositories\Interfaces\TagRepositoryInterface;

class CatalogController extends Controller
{
    protected $catalogRepository;

    private $storeRepository;

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

    protected function setLocale($request)
    {
        $value = $request->session()->get('locale');

        app()->setLocale($value);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $this->setLocale($request);
        
        return view('pages.catalog.index',[
            'catalogs' => $this->catalogRepository->all(),
            'recent_stores' => $this->storeRepository->get($limit=8),
            'recent_cities' => $this->cityRepository->get($limit=8),
            'recent_countries' => $this->countryRepository->get($limit=5),
            'tags' => $this->tagRepository->all(),
            'recent_stores' => $this->storeRepository->get($limit=8),
            'social'=> $this->socialRepository->all(),
            'all_cites' => $this->cityRepository->all(),

        ]);

    }

    public function search( Request $request)
    {
        $validatedData = $request->validate([
            'search' => 'required'
        ]);

        $this->setLocale($request);
        
        return view('pages.catalog.search',[
            'searched_item' => $request->search,
            'catalogs' => $this->catalogRepository->search($request->search),
            'recent_stores' => $this->storeRepository->get($limit=8),
            'recent_cities' => $this->cityRepository->get($limit=8),
            'recent_countries' => $this->countryRepository->get($limit=5),
            'tags' => $this->tagRepository->all(),
            'recent_stores' => $this->storeRepository->get($limit=8),
            'social'=> $this->socialRepository->all(),
            'all_cites' => $this->cityRepository->all()

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
    public function show(Request $request, Store $store ,Catalog $catalog)
    {

        $this->setLocale($request);

        // if($catalog->end_at >= date('Y-m-d')){
        //     dd('not expired');
        // }else{
        //     dd('expried');
        // }
        //increment total_views of the catalog
        $this->catalogRepository->viewed($catalog);

        return view('pages.catalog.show',[
            'catalog' => $catalog,
            'catalog_cities' => $this->catalogRepository->inCities($catalog),
            'latest_catalogs'=> $this->catalogRepository->latest($limit=4),
            'page_description' => $catalog->page,
            'recent_stores' => $this->storeRepository->get($limit=8),
            'recent_cities' => $this->cityRepository->get($limit=8),
            'recent_countries' => $this->countryRepository->get($limit=5),
            'store' => $store,
            'in_cities' =>  $this->storeRepository->availableInCities($store),
            'recent_stores' => $this->storeRepository->get($limit=8),
            'recent_cities' => $this->cityRepository->get($limit=8),
            'recent_countries' => $this->countryRepository->get($limit=5),
            'page_description' => $store->page,
            'store_catalogs' => $store->catalogs,
            'catalog_images' => $catalog->images->paginate(9),
            'catalog_small_sections' => $this->advertisementRepository->get('catalog-small-section'),
            'catalog_large_sections' => $this->advertisementRepository->get('catalog-large-section'),
            'social'=> $this->socialRepository->all(),
            'all_cites' => $this->cityRepository->all()


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
