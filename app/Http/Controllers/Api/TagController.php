<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Seo;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Tag::get();
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
            'name' => 'required',
            'arabic_name' => 'required'
        ]);
        
        $slug = Str::slug($request->name , '-');

        $nameAlreadyExist = Tag::where('slug', $slug)->exists();
       // \Log::info($nameAlreadyExist);exit;
        if(!$nameAlreadyExist){
            $tag = new Tag;

            $tag->setTranslation('name', 'en', $request->name);
            $tag->setTranslation('name', 'ar', $request->arabic_name);
    
            $tag->slug = $slug;
            $tag->save();
    
            /*
            * associate the seo tags with
            * the tag
            */
            $seoTags = new Seo; 
            $seoTags->setTranslation('title', 'en', $request->seo_title);
            $seoTags->setTranslation('title', 'ar', $request->arabic_seo_title);
            $seoTags->setTranslation('description', 'en', $request->seo_description);
            $seoTags->setTranslation('description', 'ar', $request->arabic_seo_description);
            
            $tag->seoTags()->save($seoTags);
        }  
        else{
            return [
                'error' => true,
                'message' => 'Data already exist'
            ];
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
            'id' => 'required',
            'name' => 'required|max:255',
            'arabic_name' => 'required'
        ]);

        $tag = Tag::find($request->id);

        $tag->setTranslation('name', 'en', $request->name);
        $tag->setTranslation('name', 'ar', $request->arabic_name);

        $tag->slug = Str::slug($request->name , '-');
        $tag->save();

         /*
        * update the tag's seo tags
        */
        $seoTags = $tag->seoTags; 
        $seoTags->setTranslation('title', 'en', $request->seo_title);
        $seoTags->setTranslation('title', 'ar', $request->arabic_seo_title);
        $seoTags->setTranslation('description', 'en', $request->seo_description);
        $seoTags->setTranslation('description', 'ar', $request->arabic_seo_description);
        
        $tag->seoTags()->save($seoTags);

    }

    /**
     * Toggle the tag status
     */
    public function toggleStatus(Request $request) {

        $validatedData = $request->validate([
            'id' => 'required',
            'status' => 'required'
        ]);

        $tag = Tag::find($request->id);
        $tag->status = $request->status;
        $tag->save();
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
