<?php

namespace App\Http\Controllers\Themes\Basic;
use Illuminate\Http\Request;
use App\Models\Product;
use Session ;

class HomeController extends ThemeController
{  
    /**
     * Show the homepage.
     *
     * @return Response
     */
    public function index()
    {
      $products = Product::where('shop_id', Session::get('shop'))->get() ;
      return view('themes/basic/home', ['products' => $products]);
    }

}