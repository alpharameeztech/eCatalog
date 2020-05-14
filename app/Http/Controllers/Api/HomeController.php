<?php

namespace App\Http\Controllers\Api;

use App\Home;
use App\Http\Controllers\Controller;
use App\Seo;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Home::get();
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
            'seo_title' => 'required',
            'arabic_seo_title' => 'required',
            'seo_description' => 'required',
            'arabic_seo_description' => 'required',
            'page_description' => 'required',
            'arabic_page_description' => 'required'
        ]);


        $home = new Home;

        $home->setTranslation('seo_title', 'en', $request->seo_title);
        $home->setTranslation('seo_title', 'ar', $request->arabic_seo_title);

        $home->setTranslation('seo_description', 'en', $request->seo_description);
        $home->setTranslation('seo_description', 'ar', $request->arabic_seo_description);

        $home->setTranslation('page_description', 'en', $request->page_description);
        $home->setTranslation('page_description', 'ar', $request->arabic_page_description);

        $home->save();

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
    public function update(Request $request, Home $home)
    {

        $validatedData = $request->validate([
            'seo_title' => 'required',
            'arabic_seo_title' => 'required',
            'seo_description' => 'required',
            'arabic_seo_description' => 'required',
            'page_description' => 'required',
            'arabic_page_description' => 'required'
        ]);


        $home->setTranslation('seo_title', 'en', $request->seo_title);
        $home->setTranslation('seo_title', 'ar', $request->arabic_seo_title);

        $home->setTranslation('seo_description', 'en', $request->seo_description);
        $home->setTranslation('seo_description', 'ar', $request->arabic_seo_description);

        $home->setTranslation('page_description', 'en', $request->page_description);
        $home->setTranslation('page_description', 'ar', $request->arabic_page_description);

        $home->save();
    }

    /*
    * Upload the image to the s3
    * and return the url
    */
    public function uploadImage(Request $request){

        $image =  request()->file('image')->store('blog', 's3');

        return 'https://ecatalog.s3-ap-southeast-1.amazonaws.com/' . $image;

    }

    /**
     * Toggle the Blog status
     */
    public function toggleStatus(Blog $blog) {

        $blog->status = !$blog->status;
        $blog->save();
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
