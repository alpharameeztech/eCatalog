<?php

namespace App\Http\Controllers;

use App\Catalog;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function setLanguage(Request $request, $language)
    {
        app()->setLocale($language);
        session(['locale' => $language]);

       // $catalog = Catalog::find(6);
//        dd($catalog->name);
//        dd(app()->getLocale());
       // return redirect('/');
        return redirect()->back();
    }
}
