<?php

namespace App\Http\Controllers\Themes\Basic;
use App\Models\Category;
use App\Models\Product;
use Input ;
use Session ;

class CategoriesController extends ThemeController
{

  /**
   * List all categories
   *
   * @return Response
   */
  public function index()
  {
    return view('themes/basic/categories/index');
  }
  
  /**
   * Show Category
   *
   * @return Response
   */
  public function show($slug)
  {
    $category = Category::where('slug', $slug)->first() ;
    //$products = Product::whereIn('categories', [$category->id] )->get() ;
    if(!$category) \App::abort(404); 
    $products = Product::whereIn('_id', $category->products )->get() ;

    return view('themes/basic/categories/show', ['category' => $category, 'products' => $products]);
  }

}