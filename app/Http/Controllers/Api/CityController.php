<?php

namespace App\Http\Controllers\Api;

use App\City;
use App\Http\Controllers\Controller;
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
            'country_id' => 'required',
        ]);

        $city = new City();
       
        $city->setTranslation('name', 'en', $request->name);
        $city->setTranslation('name', 'ar', $request->arabic_name);

        $city->slug = Str::slug($request->name , '-');
        $city->country_id = $request->country_id;
        $city->save();
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
    public function update(Request $request)
    {
        
        $validatedData = $request->validate([
            'id' => 'required',
            'name' => 'required|max:255',
            'arabic_name' => 'required',
            'country_id' => 'required',
        ]);

        $city = City::find($request->id);
        
        $city->setTranslation('name', 'en', $request->name);
        $city->setTranslation('name', 'ar', $request->arabic_name);
        
        $city->slug = Str::slug($request->name , '-');
        $city->country_id = $request->country_id;
        $city->save();
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
