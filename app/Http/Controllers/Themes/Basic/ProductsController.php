<?php

namespace App\Http\Controllers\Themes\Basic;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category ;
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
  
  /**
   * searchs Products
   *
   * @return Response
   */
  public function search(Request $request, $category = NULL)
  {
    if ($request->has('query')) {
      $searchTerm = $request->input('query') ;
      Session::put('query', $searchTerm) ;
    }
    
    // search
    $products = new Product() ;
    $products = $products->where('shop_id', Session::get('shop')) ;
    //query
    if(Session::has('query')){
      $products = $products->where('en.name', 'LIKE', '%'.Session::get('query').'%') ;
    }
    // category
    if($category){
      $category = Category::where('slug', $category)->pluck('_id')[0];
      $products = $products->whereIn('categories', [$category] ) ;
    }
    $products = $products->get() ;
    return view('themes/basic/products/search', ['products' => $products]);
  }

}