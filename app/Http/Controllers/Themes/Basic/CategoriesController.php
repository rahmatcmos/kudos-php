<?php

namespace App\Http\Controllers\Themes\Basic;
use App\Models\Category;
use App\Models\Product;
use Input ;
use Session ;

class CategoriesController extends ThemeController
{
  
  /**
   * Show Category
   *
   * @return Response
   */
  public function show($slug)
  {
    $category = Category::where('slug', $slug)->first() ;
    if(!$category) \App::abort(404);
    
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
    $products = Product::whereIn('_id', $category->products )
      ->orderBy($orderby, Session::get($session_type.'.order_dir'))
      ->paginate($limit) ;

    return view('themes/basic/categories/show', ['category' => $category, 'products' => $products]);
  }

}