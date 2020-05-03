<?php

namespace App\Http\Controllers\Api;

use App\Country;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Page;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Country::get();
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
            'name' => 'required|unique:countries|max:255',
            'arabic_name' => 'required',
            'description' => 'required',
            'arabic_description' => 'required',
        ]);

        $country = new Country;

        $country->setTranslation('name', 'en', $request->name);
        $country->setTranslation('name', 'ar', $request->arabic_name);

        $country->slug = Str::slug($request->name , '-');
        $country->save();
        
        // add the page description
        $page = new Page; 
        $page->setTranslation('description', 'en', $request->description);
        $page->setTranslation('description', 'ar', $request->arabic_description);
        $country->page()->save($page);
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
    public function update(Country $country, Request $request )
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'arabic_name' => 'required',
            'description' => 'required',
            'arabic_description' => 'required',
        ]);

        $country->setTranslation('name', 'en', $request->name);
        $country->setTranslation('name', 'ar', $request->arabic_name);

        $country->slug = Str::slug($request->name , '-');
        $country->save();

        //update the page description
        $page = $country->page; 
        $page->setTranslation('description', 'en', $request->description);
        $page->setTranslation('description', 'ar', $request->arabic_description);
        $country->page()->save($page);
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
