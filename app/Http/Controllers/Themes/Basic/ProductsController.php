<?php
namespace App\Http\Controllers\Themes\Basic;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category ;

class ProductsController extends ThemeController
{
  
  /**
   * Show all products
   *
   * @return Response
   */
  public function index(Request $request)
  {
    // pagination
    $session_type = 'product' ;
    if (!$request->session()->has('order_by')) $request->session()->put($session_type.'.order_by', 'created_at') ;
    if (!$request->session()->has('order_dir')) $request->session()->put($session_type.'.order_dir', 'desc') ;
    if ($request->order_by) $request->session()->put($session_type.'.order_by', $request->order_by) ;
    if ($request->order_dir) $request->session()->put($session_type.'.order_dir', $request->order_dir) ;
    
    $orderby = $request->session()->get($session_type.'.order_by') == 'created_at'
      ? $request->session()->get($session_type.'.order_by')
      : $request->session()->get('language').'.'.$request->session()->get($session_type.'.order_by') ;
    
    $limit = $request->session()->get('limit') ;
    $products = Product::where('shop_id', $request->session()->get('shop'))
      ->orderBy($orderby, $request->session()->get($session_type.'.order_dir'))
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
   * search Products
   *
   * @return Response
   */
  public function search(Request $request, $category = NULL)
  {
    // pagination
    $session_type = 'product' ;
    if (!$request->session()->has('order_by')) $request->session()->put($session_type.'.order_by', 'created_at') ;
    if (!$request->session()->has('order_dir')) $request->session()->put($session_type.'.order_dir', 'desc') ;
    if ($request->order_by) $request->session()->put($session_type.'.order_by', $request->order_by) ;
    if ($request->order_dir) $request->session()->put($session_type.'.order_dir', $request->order_dir) ;
    
    $orderby = $request->session()->get($session_type.'.order_by') == 'created_at'
      ? $request->session()->get($session_type.'.order_by')
      : $request->session()->get('language').'.'.$request->session()->get($session_type.'.order_by') ;

    if ($request->has('query')) {
      $searchTerm = $request->input('query') ;
      $request->session()->put('query', $searchTerm) ;
    }
    
    // search
    $products = new Product() ;
    $products = $products->where('shop_id', $request->session()->get('shop')) ;
    //query
    if($request->session()->has('query')){
      $products = $products->where('en.name', 'LIKE', '%'.$request->session()->get('query').'%') ;
    }
    // category
    if($category){
      $category = Category::where('slug', $category)->pluck('_id')[0];
      $products = $products->whereIn('categories', [$category] ) ;
    }
    $limit = $request->session()->get('limit') ;
    $products = $products->orderBy($orderby, $request->session()->get($session_type.'.order_dir'))
      ->paginate($limit);
    return view('themes/basic/products/search', ['products' => $products]);
  }

}