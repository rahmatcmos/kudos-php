<?php

namespace App\Http\Controllers\Themes\Basic;
use Illuminate\Http\Request;
use Session ;

class HomeController extends \App\Http\Controllers\Controller
{  
    /**
     * Show the homepage.
     *
     * @return Response
     */
    public function index()
    {
      return view('themes/basic/home');
    }

}