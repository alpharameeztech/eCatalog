<?php

namespace App\Http\Controllers\Api;

use App\Blog;
use App\Http\Controllers\Controller;
use App\Seo;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Blog::get();
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
//        \Log::info($request);
//        return;

        if($request->id){
            // update the store information
            return $this->update($request);
        }
        else{
            $validatedData = $request->validate([
                'profilePicture' => 'required',
                'title' => 'required',
                'arabic_title' => 'required',
                'body' => 'required',
                'arabic_body' => 'required',
                'seo_title' => 'required',
                'arabic_seo_title' => 'required',
                'seo_description' => 'required',
                'arabic_seo_description' => 'required'
            ]);

            $blog = new Blog;

            $blog->image = request()->file('profilePicture')->store('blog', 's3');

            $blog->slug = Str::of($request->title)->slug('-');

            $blog->setTranslation('title', 'en', $request->title);
            $blog->setTranslation('title', 'ar', $request->arabic_title);

            $blog->setTranslation('body', 'en', $request->body);
            $blog->setTranslation('body', 'ar', $request->arabic_body);

            $blog->save();

            /*
            * add the blogs's seo tags
            */
            $seoTags = new Seo;
            $seoTags->setTranslation('title', 'en', $request->seo_title);
            $seoTags->setTranslation('title', 'ar', $request->arabic_seo_title);
            $seoTags->setTranslation('description', 'en', $request->seo_description);
            $seoTags->setTranslation('description', 'ar', $request->arabic_seo_description);
            $blog->seoTags()->save($seoTags);
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
            'title' => 'required',
            'arabic_title' => 'required',
            'body' => 'required',
            'arabic_body' => 'required',
            'seo_title' => 'required',
            'arabic_seo_title' => 'required',
            'seo_description' => 'required',
            'arabic_seo_description' => 'required'
        ]);
        $blog = Blog::find($request->id);

        if (!empty(request()->file('profilePicture'))) {
            $blog->image = request()->file('profilePicture')->store('blog', 's3');
        }

        $blog->slug = Str::of($request->title)->slug('-');

        $blog->setTranslation('title', 'en', $request->title);
        $blog->setTranslation('title', 'ar', $request->arabic_title);

        $blog->setTranslation('body', 'en', $request->body);
        $blog->setTranslation('body', 'ar', $request->arabic_body);

        $blog->save();

        /*
        * update the blog's seo tags
        */
        $seoTags = $blog->seoTags;
        $seoTags->setTranslation('title', 'en', $request->seo_title);
        $seoTags->setTranslation('title', 'ar', $request->arabic_seo_title);
        $seoTags->setTranslation('description', 'en', $request->seo_description);
        $seoTags->setTranslation('description', 'ar', $request->arabic_seo_description);
        $blog->seoTags()->save($seoTags);
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
