<?php

namespace App\Http\Controllers\Simple;
use Illuminate\Http\Request;
use Session ;

class SimpleController extends FrontendController
{  
    /**
     * Show the homepage.
     *
     * @return Response
     */
    public function index()
    {
      return 'simple homepage' ;
      //return view('themes/basic/home');
    }

}