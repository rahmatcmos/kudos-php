<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use App\Models\Shop;
use Redirect ;
use Session ;

class Controller extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;
    
    public function __construct()
    {      
      // if session is not set reset the session for the language
      if ( !Session::has('language')){
        Session::put('language', config('app.locale')) ;
      }
      
      view()->share('languages', $this->languages);
      view()->share('language', Session::get('language')) ;
    }
}
