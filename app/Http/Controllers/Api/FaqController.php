<?php

namespace App\Http\Controllers\Api;

use App\Faq;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Faq::get();
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
            'question' => 'required',
            'arabic_question' => 'required',
            'answer' => 'required',
            'arabic_answer' => 'required',
        ]);

        $faq = new Faq;

        $faq->setTranslation('question', 'en', $request->question);
        $faq->setTranslation('question', 'ar', $request->arabic_question);

        $faq->setTranslation('answer', 'en', $request->answer);
        $faq->setTranslation('answer', 'ar', $request->arabic_answer);

        $faq->save();
        
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
    public function update(Request $request, Faq $faq)
    {
        $validatedData = $request->validate([
            'question' => 'required',
            'arabic_question' => 'required',
            'answer' => 'required',
            'arabic_answer' => 'required',
        ]);

        $faq->setTranslation('question', 'en', $request->question);
        $faq->setTranslation('question', 'ar', $request->arabic_question);

        $faq->setTranslation('answer', 'en', $request->answer);
        $faq->setTranslation('answer', 'ar', $request->arabic_answer);

        $faq->save();
        
    }

     /**
     * Toggle the faq status
     */
    public function toggleStatus(Request $request) {

        $validatedData = $request->validate([
            'id' => 'required',
        ]);

        $faq = Faq::find($request->id);
        $faq->status = !$faq->status;
        $faq->save();
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
