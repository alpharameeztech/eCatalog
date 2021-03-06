<?php

namespace App\Http\Controllers\Api;

use App\Branch;
use App\Http\Controllers\Controller;
use App\Seo;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Page;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Branch::get();
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
        $validatedData = $request->validate([
            'name' => 'required|unique:branches|max:255',
            'arabic_name' => 'required|max:255',
            'opening_hours' => 'required',
            'arabic_opening_hours' => 'required',
            'city' => 'required',
            'country' => 'required',
            'address' => 'required',
            'arabic_address'=> 'required',
            'description' => 'required',
            'arabic_description' => 'required',
        ]);

        $branch = new Branch();
        $country_id = '';

        if(is_array($request->country)){
            $country_id = $request->country['id'];
        }else{
            $country_id = $request->country;
        }
        //$store->name = Str::of($request->name)->trim();
        $branch->setTranslation('name', 'en', $request->name);
        $branch->setTranslation('name', 'ar', $request->arabic_name);

        $branch->slug = Str::of($request->name)->slug('-');

        $branch->telephone = $request->telephone;
        $branch->fax = $request->fax;
        $branch->email = $request->email;

        $branch->setTranslation('opening_hours', 'en', $request->opening_hours);
        $branch->setTranslation('opening_hours', 'ar', $request->arabic_opening_hours);

        $branch->map_location = $request->map_location;
        $branch->city_id = $request->city['id'];
        $branch->country_id = $country_id;
        $branch->store_id = $request->store['id'];

        if($request->mall){
            $branch->mall_id = $request->mall['id'];
        }


        $branch->setTranslation('address', 'en', $request->address);
        $branch->setTranslation('address', 'ar', $request->arabic_address);

        $branch->save();

        /*
        * associate the seo tags with
        * the store's branch
        */
        $seoTags = new Seo;
        $seoTags->setTranslation('title', 'en', $request->seo_title);
        $seoTags->setTranslation('title', 'ar', $request->arabic_seo_title);
        $seoTags->setTranslation('description', 'en', $request->seo_description);
        $seoTags->setTranslation('description', 'ar', $request->arabic_seo_description);

        $branch->seoTags()->save($seoTags);

        // add the page description
        $page = new Page;
        $page->setTranslation('description', 'en', $request->description);
        $page->setTranslation('description', 'ar', $request->arabic_description);
        $branch->page()->save($page);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update(Branch $branch, Request $request)
    {
        \Log::info($request->country);
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'arabic_name' => 'required|max:255',
            'opening_hours' => 'required',
            'arabic_opening_hours' => 'required',
            'city' => 'required',
            'country' => 'required',
            'address' => 'required',
            'arabic_address'=> 'required',
            'description' => 'required',
            'arabic_description' => 'required',
        ]);
        $country_id = '';

        if(is_array($request->country)){
            $country_id = $request->country['id'];
        }else{
            $country_id = $request->country;
        }
        //$store->name = Str::of($request->name)->trim();
        $branch->setTranslation('name', 'en', $request->name);
        $branch->setTranslation('name', 'ar', $request->arabic_name);

        $branch->slug = Str::of($request->name)->slug('-');

        $branch->telephone = $request->telephone;
        $branch->fax = $request->fax;
        $branch->email = $request->email;

        $branch->setTranslation('opening_hours', 'en', $request->opening_hours);
        $branch->setTranslation('opening_hours', 'ar', $request->arabic_opening_hours);

        $branch->map_location = $request->map_location;
        $branch->city_id = $request->city['id'];
        $branch->country_id = $country_id;
        $branch->store_id = $request->store['id'];

        if($request->mall){
            $branch->mall_id = $request->mall['id'];
        }


        $branch->setTranslation('address', 'en', $request->address);
        $branch->setTranslation('address', 'ar', $request->arabic_address);

        $branch->save();

        /*
        * update the store's seo tags
        */
        $seoTags = $branch->seoTags;
        $seoTags->setTranslation('title', 'en', $request->seo_title);
        $seoTags->setTranslation('title', 'ar', $request->arabic_seo_title);
        $seoTags->setTranslation('description', 'en', $request->seo_description);
        $seoTags->setTranslation('description', 'ar', $request->arabic_seo_description);

        $branch->seoTags()->save($seoTags);

        //update the page description
        $page = $branch->page;
        $page->setTranslation('description', 'en', $request->description);
        $page->setTranslation('description', 'ar', $request->arabic_description);
        $branch->page()->save($page);

    }
    /**
     * Toggle the branch status
     */
    public function toggleStatus(Request $request) {

        $validatedData = $request->validate([
            'id' => 'required',
            'status' => 'required'
        ]);

        $branch = Branch::find($request->id);
        $branch->status = $request->status;
        $branch->save();
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
