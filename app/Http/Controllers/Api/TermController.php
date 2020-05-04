<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Term;
use Illuminate\Http\Request;

class TermController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Term::get();
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
            'title' => 'required',
            'arabic_title' => 'required',
            'description' => 'required',
            'arabic_description' => 'required',
        ]);

        $term = new Term;

        $term->setTranslation('title', 'en', $request->title);
        $term->setTranslation('title', 'ar', $request->arabic_title);

        $term->setTranslation('description', 'en', $request->description);
        $term->setTranslation('description', 'ar', $request->arabic_description);

        $term->save();
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
    public function update(Request $request, Term $term)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'arabic_title' => 'required',
            'description' => 'required',
            'arabic_description' => 'required',
        ]);

        $term->setTranslation('title', 'en', $request->title);
        $term->setTranslation('title', 'ar', $request->arabic_title);

        $term->setTranslation('description', 'en', $request->description);
        $term->setTranslation('description', 'ar', $request->arabic_description);

        $term->save();
    }

    /**
     * Toggle the term status
     */
    public function toggleStatus(Request $request) {

        $validatedData = $request->validate([
            'id' => 'required',
        ]);

        $term = Term::find($request->id);
        $term->status = !$term->status;
        $term->save();
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
