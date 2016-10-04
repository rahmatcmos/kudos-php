<?php
namespace App\Http\Controllers\Simple;

use App\Models\Language ;

class FrontendController extends \App\Http\Controllers\Controller
{
    public function __construct()
    {
      
      // if session is not set reset the session for the language
      if ( !$request->session()->has('language')){
        $request->session()->put('language', config('app.locale')) ;
      }
      
      view()->share('languages', Language::LANGUAGES);
      view()->share('language', $request->session()->get('language')) ;
    }
}
