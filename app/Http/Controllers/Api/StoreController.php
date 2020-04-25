<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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
            // add a new store
            $validatedData = $request->validate([
                'profilePicture' => 'required',
                'name' => 'required|unique:stores|max:255',
                'websiteLink' => 'required',
                'facebookLink' => 'required',
                'about' => 'required',
            ]);
    
            $store = new Store;
            $store->image = request()->file('profilePicture')->store('stores', 's3');
            $store->name = Str::of($request->name)->trim();
            $store->slug = Str::slug($store->name , '-');
            $store->website_link = Str::of($request->websiteLink)->trim();
            $store->facebook_link = Str::of($request->facebookLink)->trim();
            $store->about = Str::of($request->about)->trim();
            $store->save();
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
            'name' => 'required|unique:stores|max:255',
            'websiteLink' => 'required',
            'facebookLink' => 'required',
            'about' => 'required',
        ]);

        $store = Store::find($request->id);
       
        if (!empty(request()->file('profilePicture'))) {
            $store->image = request()->file('profilePicture')->store('stores', 's3');
        }

        $store->name = Str::of($request->name)->trim();
        $store->slug = Str::slug($store->name , '-');
        $store->website_link = Str::of($request->websiteLink)->trim();
        $store->facebook_link = Str::of($request->facebookLink)->trim();
        $store->about = Str::of($request->about)->trim();
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
