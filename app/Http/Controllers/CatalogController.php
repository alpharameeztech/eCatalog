<?php

namespace App\Http\Controllers;

use App\Catalog;
use App\Repositories\Interfaces\CatalogRepositoryInterface;
use App\Store;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    protected $catalogRepository;

    public function __construct(CatalogRepositoryInterface $catalogRepository)
    {
        $this->catalogRepository = $catalogRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.catalog.index',[
            'catalogs' => $this->catalogRepository->all(),
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
    public function show(Store $store ,Catalog $catalog)
    {
        //increment total_views of the catalog
        $this->catalogRepository->viewed($catalog);

        return view('pages.catalog.show',[
            'catalog' => $catalog,
            'catalog_cities' => $this->catalogRepository->inCities($catalog),
            'latest_catalogs'=> $this->catalogRepository->latest(),
            'page_description' => $catalog->page
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
