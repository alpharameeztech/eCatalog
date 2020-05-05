<?php

namespace App\Http\Controllers\Api;

use App\Blog;
use App\Http\Controllers\Controller;
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
        \Log::info($request);return;
        // $validatedData = $request->validate([
        //     'title' => 'required',
        //     'arabic_title' => 'required',
        //     'description' => 'required',
        //     'arabic_description' => 'required',
        // ]);

        $blog = new Blog;
        
        $blog->slug = Str::of($request->title)->slug('-');
        
        $blog->setTranslation('title', 'en', $request->title);
        $blog->setTranslation('title', 'ar', $request->arabic_title);

        $blog->setTranslation('body', 'en', $request->body);
        $blog->setTranslation('body', 'ar', $request->arabic_body);

        $blog->save();
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
    public function update(Request $request, Blog $blog)
    {
        //$blog->slug = Str::of($request->title)->slug('-');
        
        $blog->setTranslation('title', 'en', $request->title);
        $blog->setTranslation('title', 'ar', $request->arabic_title);

        $blog->setTranslation('body', 'en', $request->body);
        $blog->setTranslation('body', 'ar', $request->arabic_body);

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
