<?php

namespace App\Http\Controllers;

use App\Home;
use App\Repositories\BannerRepository;
use App\Repositories\Interfaces\BannerRepositoryInterface;
use App\Repositories\Interfaces\BlogRepositoryInterface;
use App\Repositories\Interfaces\CatalogRepositoryInterface;
use App\Repositories\Interfaces\StoreRepositoryInterface;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private $storeRepository;

    private $catalogRepository;

    private $bannerRepository;

    private $blogRepository;


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        StoreRepositoryInterface $storeRepository,
        CatalogRepositoryInterface $catalogRepository,
        BannerRepositoryInterface $bannerRepository,
        BlogRepositoryInterface $blogRepository
    )
    {
        $this->storeRepository = $storeRepository;
        $this->catalogRepository = $catalogRepository;
        $this->bannerRepository = $bannerRepository;
        $this->blogRepository = $blogRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        
        $stores = $this->storeRepository->all();
        $latest_catalogs = $this->catalogRepository->latest(4);
        $popular_catalogs =  $this->catalogRepository->popular();
        $featured_catalogs = $this->catalogRepository->featured();
        return view('home',[
            'stores' => $stores,
            'latest_catalogs' => $latest_catalogs,
            'popular_catalogs' => $popular_catalogs,
            'featured_catalogs' => $featured_catalogs,
            'page_description' => Home::first(),
            'banners' => $this->bannerRepository->all(),
            'latest_blog' => $this->blogRepository->latest(1),
            'recent_stores' => $this->storeRepository->get($limit=8)
        ]);
    }
}
