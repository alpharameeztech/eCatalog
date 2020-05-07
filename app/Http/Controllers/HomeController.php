<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\StoreRepositoryInterface;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private $storeRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(StoreRepositoryInterface $storeRepository)
    {
        $this->storeRepository = $storeRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $stores = $this->storeRepository->all();

        return view('home',[
            'stores' => $stores
        ]);
    }
}
