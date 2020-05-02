<?php

namespace App\Http\Controllers\Api;

use App\Catalog;
use App\Http\Controllers\Controller;
use App\Image;
use App\Pdf;
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
            'branches' => 'required',
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
        
        //if catalog has no expiry
        //then set the to null
        if ($request->for_unlimited_time) {
            $catalog->setTranslation('end_at', 'en', null);
            $catalog->setTranslation('end_at', 'ar', null);
        }
        else{
            $catalog->setTranslation('end_at', 'en', $request->end_at);
            $catalog->setTranslation('end_at', 'ar', $request->arabic_end_at);
        }
        
        $catalog->store_id = $request->store['id'];

        //check whether the catalog is
        //marked as featured
        //if yes, then save it
        if($request->featured && $request->featured_expiry_at != null){
            $catalog->featured = true;
            $catalog->featured_expiry_at =  $request->featured_expiry_at;
        }

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
         
        // sync the catalog tags
        $catalog->tags()->sync($request->tags);

        // sync catalog with the branches
        $catalog->branches()->sync($request->branches);
        
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
            'name' => 'required|max:500',
            'arabic_name' => 'required|max:255',
            'start_at' => 'required',
            'store' => 'required',
            'branches' => 'required',
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
        
        //if catalog has no expiry
        //then set the to null
        if ($request->for_unlimited_time) {
            $catalog->setTranslation('end_at', 'en', null);
            $catalog->setTranslation('end_at', 'ar', null);
        }
        else{
            $catalog->setTranslation('end_at', 'en', $request->end_at);
            $catalog->setTranslation('end_at', 'ar', $request->arabic_end_at);
        }
        
        //check whether the catalog is
        //marked as featured
        //if yes, then save it
        if($request->featured && $request->featured_expiry_at != null){
            $catalog->featured = true;
            $catalog->featured_expiry_at =  $request->featured_expiry_at;
        }else{
            $catalog->featured = false;
            $catalog->featured_expiry_at =  null;
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

        // sync the catalog tags
        // if the user has updated 
        if( count($request->tags) && !is_array($request->tags[0])){
            $catalog->tags()->sync($request->tags); // if provided with tags
        }elseif( count($request->tags) == 0){
            $catalog->tags()->sync([]); // if provided with no tags
        }else{

        }

        // sync catalog with the branches
        if( count($request->branches) &&  !is_array($request->branches[0])){
            $catalog->branches()->sync($request->branches); // if provided branches
        }elseif( count($request->branches) == 0){
            $catalog->branches()->sync([]); // if provided with no branches
        }else{

        }

    }

    /**
     * Save the updated order of the
     * catalog images
     */
    public function reorderImages(Request $request)
    {
        
        foreach($request->images as $key=> $image){
            $imageModel = Image::find($image['id']);
            $imageModel->update(['order' => ++$key]);
        }

    }

    /**
     * Toggle the catalog status
     */
    public function toggleStatus(Request $request) {

        $validatedData = $request->validate([
            'id' => 'required',
            'status' => 'required'
        ]);

        $catalog = Catalog::find($request->id);
        $catalog->status = $request->status;
        $catalog->save();
    }

    /**
     * Store a catalog image
     */
    public function storeImages(Request $request){
        $validatedData = $request->validate([
            'id' => 'required',
            'file' => 'required'
        ]);

        $new_image = request()->file('file')->store('catalogs', 's3');
        
        $catalog = Catalog::find($request->id);

        $image = new Image;

        $image->image = $new_image; 
        $response = $catalog->images()->save($image);
            
        /*
        * if this imag has been marked as 
        * featured, then save with the catalog
        */
        if($request->featured == 'true'){
            // $catalog->image_id = $response->id;
            // $catalog->save();
            $image->featured = true; 

            $response = $catalog->images()->save($image);
        }
    }

     /**
     * Store a catalog pdf
     */
    public function storePdf(Request $request){
        $validatedData = $request->validate([
            'id' => 'required',
            'file' => 'required'
        ]);

        $new_pdf = request()->file('file')->store('catalogs', 's3');
        
        $catalog = Catalog::find($request->id);

        $pdf = new Pdf;

        $pdf->pdf = $new_pdf; 
        $catalog->pdfs()->save($pdf);
            
    }

    public function toggleFeaturedImage(Request $request){
        $validatedData = $request->validate([
            'image' => 'required',
        ]);
            
        $image = Image::find($request->image['id']);
        $image->featured = !$image->featured;
        $image->save();
        
    }

    /**
     * delete a catalog image
     */
    public function deleteImage(Request $request)
    {
        $catalog = Catalog::find($request->image['imageable_id']);
        $catalog->images()->where('id', $request->image['id'])->delete();
    }

     /**
     * delete a catalog pdf
     */
    public function deletePdf(Request $request)
    {
        $catalog = Catalog::find($request->pdf['pdfable_id']);
        $catalog->pdfs()->where('id', $request->pdf['id'])->delete();
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
