<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mall;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MallController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Mall::get();
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
            'name' => 'required|unique:malls|max:255',
            'arabicName' => 'required|max:255',
            'openingHours' => 'required',
            'arabicOpeningHours' => 'required',
            'mapLocation' => 'required',
            'cityId' => 'required',
            'address' => 'required',
            'arabicAddress'=> 'required'
        ]);

        $mall = new Mall;
       
        //$store->name = Str::of($request->name)->trim();
        $mall->setTranslation('name', 'en', $request->name);
        $mall->setTranslation('name', 'ar', $request->arabicName);
       
        $mall->slug = Str::of($request->name)->slug('-');

        $mall->telephone = $request->telephone;

        $mall->setTranslation('opening_hours', 'en', $request->openingHours);
        $mall->setTranslation('opening_hours', 'ar', $request->arabicOpeningHours);

        $mall->map_location = $request->mapLocation;
        $mall->city_id = $request->cityId;

        
        $mall->setTranslation('address', 'en', $request->address);
        $mall->setTranslation('address', 'ar', $request->arabicAddress);

        $mall->save();
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
