<?php
namespace App\Http\Controllers\Themes\Basic;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoriesController extends ThemeController
{
  
  /**
   * Show Category
   *
   * @return Response
   */
  public function show(Request $request, $slug)
  {
    $category = Category::where('slug', $slug)->first() ;
    if(!$category) \App::abort(404);
    
    // pagination
    $session_type = 'product' ;
    if (!$request->session()->has('order_by')) $request->session()->put($session_type.'.order_by', 'created_at') ;
    if (!$request->session()->has('order_dir')) $request->session()->put($session_type.'.order_dir', 'desc') ;
    if ($request->getorder_by) $request->session()->put($session_type.'.order_by', $request->order_by) ;
    if ($request->getorder_dir) $request->session()->put($session_type.'.order_dir', $request->order_dir) ;
    
    $orderby = $request->session()->get($session_type.'.order_by') == 'created_at'
      ? $request->session()->get($session_type.'.order_by')
      : $request->session()->get('language').'.'.$request->session()->get($session_type.'.order_by') ;
       
    $limit = $request->session()->get('limit') ;
    $products = Product::whereIn('_id', $category->products )
      ->orderBy($orderby, $request->session()->get($session_type.'.order_dir'))
      ->paginate($limit) ;

    return view('themes/basic/categories/show', ['category' => $category, 'products' => $products]);
  }

}