<?php

namespace App\Http\Controllers\Themes\Basic;
use App\Models\Category;
use App\Models\Product;
use Validator ;
use Input ;
use Session ;
use Redirect ;

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