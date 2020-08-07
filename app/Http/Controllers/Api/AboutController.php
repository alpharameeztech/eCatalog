<?php

namespace App\Http\Controllers\Api;

use App\About;
use App\Blog;
use App\Http\Controllers\Controller;
use App\Seo;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return About::get();
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
            $validatedData = $request->validate([
                'body' => 'required',
                'arabic_body' => 'required',
                'seo_title' => 'required',
                'arabic_seo_title' => 'required',
                'seo_description' => 'required',
                'arabic_seo_description' => 'required'
            ]);

            $about = new About;

            $about->setTranslation('body', 'en', $request->body);
            $about->setTranslation('body', 'ar', $request->arabic_body);

            $about->save();

            /*
            * add the blogs's seo tags
            */
            $seoTags = new Seo;
            $seoTags->setTranslation('title', 'en', $request->seo_title);
            $seoTags->setTranslation('title', 'ar', $request->arabic_seo_title);
            $seoTags->setTranslation('description', 'en', $request->seo_description);
            $seoTags->setTranslation('description', 'ar', $request->arabic_seo_description);
            $about->seoTags()->save($seoTags);
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
            'body' => 'required',
            'arabic_body' => 'required',
            'seo_title' => 'required',
            'arabic_seo_title' => 'required',
            'seo_description' => 'required',
            'arabic_seo_description' => 'required'
        ]);

        $about = About::find($request->id);

        $about->setTranslation('body', 'en', $request->body);
        $about->setTranslation('body', 'ar', $request->arabic_body);

        $about->save();

        /*
        * update the blog's seo tags
        */
        $seoTags = $about->seoTags;
        $seoTags->setTranslation('title', 'en', $request->seo_title);
        $seoTags->setTranslation('title', 'ar', $request->arabic_seo_title);
        $seoTags->setTranslation('description', 'en', $request->seo_description);
        $seoTags->setTranslation('description', 'ar', $request->arabic_seo_description);
        $about->seoTags()->save($seoTags);
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
