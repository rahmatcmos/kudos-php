<?php

namespace App\Http\Controllers\Themes\Basic;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category ;
use Session ;
use Input ;

class ProductsController extends ThemeController
{
  
  /**
   * Show all products
   *
   * @return Response
   */
  public function index()
  {
    // pagination
    $session_type = 'product' ;
    if (!Session::has('order_by')) Session::put($session_type.'.order_by', 'created_at') ;
    if (!Session::has('order_dir')) Session::put($session_type.'.order_dir', 'desc') ;
    if (Input::get('order_by')) Session::put($session_type.'.order_by', Input::get('order_by')) ;
    if (Input::get('order_dir')) Session::put($session_type.'.order_dir', Input::get('order_dir')) ;
    
    $orderby = Session::get($session_type.'.order_by') == 'created_at'
      ? Session::get($session_type.'.order_by')
      : Session::get('language').'.'.Session::get($session_type.'.order_by') ;
    
    $limit = Session::get('limit') ;
    $products = Product::where('shop_id', Session::get('shop'))
      ->orderBy($orderby, Session::get($session_type.'.order_dir'))
      ->paginate($limit);
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
  
  /**
   * searchs Products
   *
   * @return Response
   */
  public function search(Request $request, $category = NULL)
  {
    // pagination
    $session_type = 'product' ;
    if (!Session::has('order_by')) Session::put($session_type.'.order_by', 'created_at') ;
    if (!Session::has('order_dir')) Session::put($session_type.'.order_dir', 'desc') ;
    if (Input::get('order_by')) Session::put($session_type.'.order_by', Input::get('order_by')) ;
    if (Input::get('order_dir')) Session::put($session_type.'.order_dir', Input::get('order_dir')) ;
    
    $orderby = Session::get($session_type.'.order_by') == 'created_at'
      ? Session::get($session_type.'.order_by')
      : Session::get('language').'.'.Session::get($session_type.'.order_by') ;

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
    $limit = Session::get('limit') ;
    $products = $products->orderBy($orderby, Session::get($session_type.'.order_dir'))
      ->paginate($limit);
    return view('themes/basic/products/search', ['products' => $products]);
  }

}