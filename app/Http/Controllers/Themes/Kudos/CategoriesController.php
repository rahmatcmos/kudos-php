<?php
namespace App\Http\Controllers\Themes\Kudos;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\OptionProductValue;

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
    $products = Product::whereIn('_id', $category->products ) ; 
    
    // filters
    if($request->session()->has('filter') && !empty($request->session()->get('filter'))){
      $found = false ;
      foreach($request->session()->get('filter') as $key => $value){
        $opv = OptionProductValue::where('filter', $key.'-'.$value)->first() ; 
        if($opv){
          $found = true ;
          $products = $products->whereIn('_id', $opv ->products) ;
        }
      }
      if(!$found) {
        $request->session()->flash('danger',  trans('search.none'));
        $products = $products->whereIn('_id', []) ;
      }
    }
    
    $products = $products->orderBy($orderby, $request->session()->get($session_type.'.order_dir'))
      ->paginate($limit) ;

    return view('themes/kudos/categories/show', ['category' => $category, 'products' => $products]);
  }

}