<?php

namespace App\Http\Controllers\Themes\Basic;
use App\Models\Language ;
use Redirect ;
use Session ;

class FrontendController extends \App\Http\Controllers\Controller
{
    public function __construct()
    {
      
      // if session is not set reset the session for the language
      if ( !Session::has('language')){
        Session::put('language', config('app.locale')) ;
      }
      
      view()->share('languages', Language::LANGUAGES);
      view()->share('language', Session::get('language')) ;
    }
}
