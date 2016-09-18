<?php

namespace App\Http\Controllers\Themes\Basic;
use App\Models\Product;
use Session ;

class ProductsController extends ThemeController
{
  
  /**
   * Show Product
   *
   * @return Response
   */
  public function show($slug)
  {
    $product = Product::where('slug', $slug)->first() ;
    return view('themes/basic/products/show', ['product' => $product]);
  }

}