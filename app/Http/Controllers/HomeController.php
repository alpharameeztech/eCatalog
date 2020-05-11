<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\CatalogRepositoryInterface;
use App\Repositories\Interfaces\StoreRepositoryInterface;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private $storeRepository;

    private $catalogRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        StoreRepositoryInterface $storeRepository,
        CatalogRepositoryInterface $catalogRepository
    )
    {
        $this->storeRepository = $storeRepository;
        $this->catalogRepository = $catalogRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        
        $stores = $this->storeRepository->all();
        $latest_catalogs = $this->catalogRepository->latest();
        $popular_catalogs =  $this->catalogRepository->popular();
        $featured_catalogs = $this->catalogRepository->featured();

        return view('home',[
            'stores' => $stores,
            'latest_catalogs' => $latest_catalogs,
            'popular_catalogs' => $popular_catalogs,
            'featured_catalogs' => $featured_catalogs
        ]);
    }
}
