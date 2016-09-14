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
   * List all products
   *
   * @return Response
   */
  public function index()
  {
    $products = Product::where('shop_id', Session::get('shop'))->get() ;
    return view('themes/basic/products/index', ['products' => $products]);
  }
  
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