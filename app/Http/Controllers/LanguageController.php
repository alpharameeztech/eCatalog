<?php

namespace App\Http\Controllers;

use App\Catalog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class LanguageController extends Controller
{
    public function setLanguage(Request $request, $language)
    {
        app()->setLocale($language);
        session(['locale' => $language]);
       // dd( request()->segment(2));
        $previousUrl = url()->previous();

        if($language == 'ar'){
            $url = str_replace('en', $language,$previousUrl);
        }else{
            $url = str_replace('ar', $language,$previousUrl);
        }

        return redirect($url);
    }
}
