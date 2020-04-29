<?php

namespace App\Http\Controllers\Api;

use App\Catalog;
use App\Http\Controllers\Controller;
use App\Seo;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CatalogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Catalog::get();
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
            'name' => 'required|max:500',
            'arabic_name' => 'required|max:255',
            'start_at' => 'required',
            'store' => 'required',
            'description'=> 'required',
            'arabic_description'=> 'required'
        ]);

        $catalog = new Catalog;
            
        //name
        $catalog->setTranslation('name', 'en', $request->name);
        $catalog->setTranslation('name', 'ar', $request->arabic_name);
       
        $catalog->slug = Str::of($request->name)->slug('-');
        
        //description
        $catalog->setTranslation('description', 'en', $request->description);
        $catalog->setTranslation('description', 'ar', $request->arabic_description);
        
        //start at
        $catalog->setTranslation('start_at', 'en', $request->start_at);
        $catalog->setTranslation('start_at', 'ar', $request->arabic_start_at);
        
        //end at if applicable
        if($request->end_at){
            $catalog->setTranslation('end_at', 'en', $request->end_at);
            $catalog->setTranslation('end_at', 'ar', $request->arabic_end_at);
        }
        
        $catalog->store_id = $request->store['id'];

        $catalog->save();

        /*
        * associate the seo tags with
        * the store's catalog
        */
        $seoTags = new Seo; 
        $seoTags->setTranslation('title', 'en', $request->seo_title);
        $seoTags->setTranslation('title', 'ar', $request->arabic_seo_title);
        $seoTags->setTranslation('description', 'en', $request->seo_description);
        $seoTags->setTranslation('description', 'ar', $request->arabic_seo_description);
        
        $catalog->seoTags()->save($seoTags);
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
        \Log::info($request);

        $validatedData = $request->validate([
            'name' => 'required|max:500',
            'arabic_name' => 'required|max:255',
            'start_at' => 'required',
            'store' => 'required',
            'description'=> 'required',
            'arabic_description'=> 'required'
        ]);

        $catalog = Catalog::find($request->id);
            
        //name
        $catalog->setTranslation('name', 'en', $request->name);
        $catalog->setTranslation('name', 'ar', $request->arabic_name);
       
        $catalog->slug = Str::of($request->name)->slug('-');
        
        //description
        $catalog->setTranslation('description', 'en', $request->description);
        $catalog->setTranslation('description', 'ar', $request->arabic_description);
        
        //start at
        $catalog->setTranslation('start_at', 'en', $request->start_at);
        $catalog->setTranslation('start_at', 'ar', $request->arabic_start_at);
        
        //end at if applicable
        if($request->end_at){
            $catalog->setTranslation('end_at', 'en', $request->end_at);
            $catalog->setTranslation('end_at', 'ar', $request->arabic_end_at);
        }
        
        $catalog->store_id = $request->store['id'];

        $catalog->save();

        /*
        * associate the seo tags with
        * the store's catalog
        */
        $seoTags = $catalog->seoTags;
        $seoTags->setTranslation('title', 'en', $request->seo_title);
        $seoTags->setTranslation('title', 'ar', $request->arabic_seo_title);
        $seoTags->setTranslation('description', 'en', $request->seo_description);
        $seoTags->setTranslation('description', 'ar', $request->arabic_seo_description);
        
        $catalog->seoTags()->save($seoTags);
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
