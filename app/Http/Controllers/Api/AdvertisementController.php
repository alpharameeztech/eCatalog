<?php

namespace App\Http\Controllers\Api;

use App\Advertisement;
use App\Banner;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdvertisementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Advertisement::get();
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->id) {
            // update the store information
            return $this->update($request);
        }
        $advertisement = new Advertisement();

        if ($request->url) {
            $advertisement->setTranslation('url', 'en', $request->url);
            $advertisement->setTranslation('url', 'ar', $request->arabic_url);
        }

        if ($request->ad) {
            $advertisement->setTranslation('ad', 'en', $request->ad);
            $advertisement->setTranslation('ad', 'ar', $request->arabic_ad);

        }


        if ($request->banner) {
            $image = request()->file('banner')->store('banners', 's3');
            $arabicImage = request()->file('arabic_banner')->store('banners', 's3');
            $advertisement->setTranslation('image', 'en', $image);
            $advertisement->setTranslation('image', 'ar', $arabicImage);
        } else {
            $advertisement->setTranslation('image', 'en', 'undefined');
            $advertisement->setTranslation('image', 'ar', 'undefined');
        }

        $advertisement->location = $request->location;
        $advertisement->save();

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $advertisement = Advertisement::find($request->id);

        if ($request->url) {
            $advertisement->setTranslation('url', 'en', $request->url);
            $advertisement->setTranslation('url', 'ar', $request->arabic_url);
        }

        if ($request->ad) {
            $advertisement->setTranslation('ad', 'en', $request->ad);
            $advertisement->setTranslation('ad', 'ar', $request->arabic_ad);

        }


        if ($request->banner != NULL) {
            $image = request()->file('banner')->store('banners', 's3');
            $advertisement->setTranslation('image', 'en', $image);
        }
        if ($request->arabic_banner != NULL) {
            $arabicImage = request()->file('arabic_banner')->store('banners', 's3');
            $advertisement->setTranslation('image', 'ar', $arabicImage);
        }
        $advertisement->location = $request->location;
        $advertisement->save();
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    public function toggleStatus(Request $request)
    {
        $validatedData = $request->validate([
            'id' => 'required',
        ]);

        $advertisement = Advertisement::find($request->id);
        $advertisement->status = !$advertisement->status;
        $advertisement->save();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
