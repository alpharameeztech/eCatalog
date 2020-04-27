<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Seo;
use App\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Store::get();
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
        if($request->id){
            // update the store information
            return $this->update($request);
        }
        else{
            \Log::info($request);
            // add a new store
            $validatedData = $request->validate([
                'profilePicture' => 'required',
                'name' => 'required|unique:stores|max:255',
                'arabicName' => 'required',
                'about' => 'required',
                'arabicAbout' => 'required',
            ]);
    
            $store = new Store;
            $store->image = request()->file('profilePicture')->store('stores', 's3');
            
            //$store->name = Str::of($request->name)->trim();
            $store->setTranslation('name', 'en', $request->name);
            $store->setTranslation('name', 'ar', $request->arabicName);
           
            $store->slug = Str::of($request->name)->slug('-');
            $store->website_link = Str::of($request->websiteLink)->trim();
            $store->facebook_link = Str::of($request->facebookLink)->trim();
            $store->twitter_link = Str::of($request->twitterLink)->trim();
            $store->instagram_link = Str::of($request->instagramLink)->trim();
            $store->youtube_link = Str::of($request->youtubeLink)->trim();
            // $store->about = Str::of($request->about)->trim();

             //$store->name = Str::of($request->name)->trim();
            $store->setTranslation('about', 'en', $request->about);
            $store->setTranslation('about', 'ar', $request->arabicAbout);

            $store->save();

            /*
            * add the store's seo tags
            */
            $seoTags = new Seo; 
            $seoTags->setTranslation('title', 'en', $request->seo_title);
            $seoTags->setTranslation('title', 'ar', $request->arabic_seo_title);
            $seoTags->setTranslation('description', 'en', $request->seo_description);
            $seoTags->setTranslation('description', 'ar', $request->arabic_seo_description);
            $store->seoTags()->save($seoTags);
        }
       
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
            'name' => 'required|max:255',
            'about' => 'required',
        ]);

        $store = Store::find($request->id);
       
        if (!empty(request()->file('profilePicture'))) {
            $store->image = request()->file('profilePicture')->store('stores', 's3');
        }

        $store->setTranslation('name', 'en', $request->name);
        $store->setTranslation('name', 'ar', $request->arabicName);

        $store->slug = Str::of($request->name)->slug('-');
        $store->website_link = Str::of($request->websiteLink)->trim();
        $store->facebook_link = Str::of($request->facebookLink)->trim();
        $store->twitter_link = Str::of($request->twitterLink)->trim();
        $store->instagram_link = Str::of($request->instagramLink)->trim();
        $store->youtube_link = Str::of($request->youtubeLink)->trim();
        //$store->about = Str::of($request->about)->trim();
        $store->setTranslation('about', 'en', $request->about);
        $store->setTranslation('about', 'ar', $request->arabicAbout);

        /*
        * update the store's seo tags
        */
        $seoTags = $store->seoTags; 
        $seoTags->setTranslation('title', 'en', $request->seo_title);
        $seoTags->setTranslation('title', 'ar', $request->arabic_seo_title);
        $seoTags->setTranslation('description', 'en', $request->seo_description);
        $seoTags->setTranslation('description', 'ar', $request->arabic_seo_description);
        $store->seoTags()->save($seoTags);

        $store->save();
    }
    /**
     * Toggle the store status
     */
    public function toggleStatus(Request $request) {

        $validatedData = $request->validate([
            'id' => 'required',
            'status' => 'required'
        ]);

        $store = Store::find($request->id);
        $store->status = $request->status;
        $store->save();
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
