<?php

namespace App\Http\Controllers\Api;

use App\City;
use App\Http\Controllers\Controller;
use App\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return City::get();
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
            'name' => 'required|unique:cities|max:255',
            'arabic_name' => 'required',
            'country' => 'required',
            'description' => 'required',
            'arabic_description' => 'required',
        ]);

        $city = new City();
       
        $city->setTranslation('name', 'en', $request->name);
        $city->setTranslation('name', 'ar', $request->arabic_name);

        $city->slug = Str::slug($request->name , '-');
        $city->country_id = $request->country['id'];
        $city->save();

        // add the page description
        $page = new Page; 
        $page->setTranslation('description', 'en', $request->description);
        $page->setTranslation('description', 'ar', $request->arabic_description);
        $city->page()->save($page);
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
    public function update(City $city, Request $request)
    {
        
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'arabic_name' => 'required',
            'country' => 'required',
            'description' => 'required',
            'arabic_description' => 'required',
        ]);

        $city->setTranslation('name', 'en', $request->name);
        $city->setTranslation('name', 'ar', $request->arabic_name);
        
        $city->slug = Str::slug($request->name , '-');
        $city->country_id = $request->country['id'];
        $city->save();

        //update the page description
        $page = $city->page; 
        $page->setTranslation('description', 'en', $request->description);
        $page->setTranslation('description', 'ar', $request->arabic_description);
        $city->page()->save($page);
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
