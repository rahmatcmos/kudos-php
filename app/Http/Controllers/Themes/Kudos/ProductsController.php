<?php
namespace App\Http\Controllers\Themes\Kudos;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Models\Product;
use App\Models\Category ;
use App\Models\Option;
use App\Http\Traits\Media;
use App\Http\Traits\Options;

class ProductsController extends ThemeController
{
  use Media ;
  use Options ;
  
  /**
   * Show all products
   *
   * @return Response
   */
  public function index(Request $request)
  {
    // pagination
    $session_type = 'product' ;
    if (!$request->session()->has($session_type.'.order_by')) $request->session()->put($session_type.'.order_by', 'created_at') ;
    if (!$request->session()->has($session_type.'.order_dir')) $request->session()->put($session_type.'.order_dir', 'desc') ;
    if ($request->order_by) $request->session()->put($session_type.'.order_by', $request->order_by) ;
    if ($request->order_dir) $request->session()->put($session_type.'.order_dir', $request->order_dir) ;

    $limit = $request->session()->get('limit') ;
    $products = Product::where('shop_id', $request->session()->get('shop'))
      ->orderBy($request->session()->get($session_type.'.order_by'), $request->session()->get($session_type.'.order_dir'))
      ->paginate($limit);

    return view('themes/kudos/products/index', ['products' => $products]);
  }
  
  /**
   * Show all products for infinite scroll
   *
   * @return Response
   */
  public function scroll(Request $request)
  {
    $session_type = 'product' ;
    $limit = $request->session()->get('limit') ;
    $products = Product::where('shop_id', $request->session()->get('shop'))
      ->orderBy($request->session()->get($session_type.'.order_by'), $request->session()->get($session_type.'.order_dir'))
      ->paginate($limit);

    return view('themes/kudos/products/scroll', ['products' => $products]);
  }
  
  /**
   * Show all products for infinite scroll
   *
   * @return Redirect
   */
  public function filter(Request $request)
  {
    $session_type = 'product' ;
    if ($request->order_by) $request->session()->put($session_type.'.order_by', $request->order_by) ;
    if ($request->order_dir) $request->session()->put($session_type.'.order_dir', $request->order_dir) ;
    return redirect()->back() ;
  }
  
  /**
   * Show Product
   *
   * @return Response
   */
  public function show(Request $request, $slug)
  {
    $product = Product::where('slug', $slug)->first() ;
    
    // product options
    if($product->options){
      $product->options = Option::whereIn('_id', $product->options)->get() ;
      if($product->option_values){
        $first = $product->option_values ;
        $product->first = reset($first) ;
      }
    }

    // load only available options based on selected
    $available = [] ;
      if($product->option_values){
      foreach($product->option_values as $option){
        foreach($option['options'] as $key => $opt){
          $available[$key][$opt] = [] ; //$this->available($product, $key, $opt) ;
        }
      }
    }
    
    // product images
    $file_size = key(array_reverse(config('image.image_sizes'))) ; //smallest
    $product->files = $this->getFiles('images/products/'.$product->id.'/'.$file_size);
    
    return view('themes/kudos/products/show', ['product' => $product, 'available' => $available]);
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
    return view('themes/kudos/products/search', ['products' => $products]);
  }
  
  /**
   * get options based on current selection
   *
   * @return Json
   */
  public function optionize(Request $request, $id)
  {
    $data = $request->except(['_token', 'price', 'qty', 'id', 'sku', 'option_sku']) ;
    $initiated = $data['initiated'] ;
    unset($data['initiated']) ;
    
    $init = false ;
    $keys = [] ;
    foreach($data as $key => $option){ 
      if($init){
        //get the options based on the keys
        $data[$key] = $this->getOptions($id, $key, $keys) ;
        $nextKeys = $keys ;
      }
      $keys[$key] = $data[$key][0] ; 
      if($key == $initiated) $init = true ;
    }
    //print_r($data) ;
    return response()->json($data);
  }

}