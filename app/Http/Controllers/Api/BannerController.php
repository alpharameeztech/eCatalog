<?php

namespace App\Http\Controllers\Api;

use App\Banner;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BannerController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		return Banner::get();
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

	   $banner = new Banner;

	   if($request->url){
		$banner->setTranslation('url', 'en', $request->url);
		$banner->setTranslation('url', 'ar', $request->arabic_url);
	   }
	   
	   if ($request->ad) {
		$banner->setTranslation('ad', 'en', $request->ad);
		$banner->setTranslation('ad', 'ar', $request->arabic_ad);
 
	   }

	  
	   if($request->banner){
			$image = request()->file('banner')->store('banners', 's3');
			$arabicImage = request()->file('arabic_banner')->store('banners', 's3');
			$banner->setTranslation('image', 'en', $image);
			$banner->setTranslation('image', 'ar', $arabicImage);
		}else{
			$banner->setTranslation('image', 'en', 'undefined');
			$banner->setTranslation('image', 'ar', 'undefined');
		}

	   $banner->save();

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

	public function toggleStatus(Request $request){
        $validatedData = $request->validate([
            'id' => 'required',
        ]);
            
        $banner = Banner::find($request->id);
        $banner->status = !$banner->status;
        $banner->save();
        
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
