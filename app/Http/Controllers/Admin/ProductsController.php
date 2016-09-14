<?php

namespace App\Http\Controllers\Admin;
use App\Models\Product;
use App\Models\Category;
use App\Http\Traits\CategoriesTrait;
use App\Http\Traits\Media;
use Validator ;
use Input ;
use Session ;
use Redirect ;

class ProductsController extends AdminController
{
  use CategoriesTrait ;
  use Media ;
  
  public function __construct()
  {
    parent::__construct() ;
    view()->share('body_class', 'products');
  }

  /**
   * List all products
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
    
    $limit = Session::get('limit') ;
    $orderby = Session::get($session_type.'.order_by') == 'created_at'
      ? Session::get($session_type.'.order_by')
      : Session::get('language').'.'.Session::get($session_type.'.order_by') ;
    $products = Product::where('shop_id', '=', Session::get('shop'))
      ->orderBy($orderby, Session::get($session_type.'.order_dir'))
      ->paginate($limit);
    return view('admin/products/index', ['products' => $products]);
  }
  
  /**
   * Create a product
   *
   * @return Response
   */
  public function create()
  {
    $categories = $this->category_select() ;
    return view('admin/products/create', ['categories' => $categories]);
  }
  
  /**
   * Save a product
   * 
   * @return Redirect
   */
  public function store(  )
  {
    // validate
    $rules = [
      'name' => 'required'
    ];
    $validator = Validator::make(Input::all(), $rules);
    if ($validator->fails()) {
      return Redirect::to('admin/products/create')
        ->withErrors($validator)
        ->withInput();
    } else {
      
      // store
      $lang = Session::get('language');
      $product = new Product;
      $product->shop_id = Input::get('shop_id');
      $product->slug = Input::get('slug');
      $product->categories = Input::get('categories');
      $product->price = Input::get('price');
      $product->rrp = Input::get('rrp');
      $product->salePrice = Input::get('salePrice');
      $data = Input::except(['shop_id', 'categories', 'slug', '_token', '_method', 'price', 'rrp', 'salePrice']) ;
      $product->$lang = $data ;
      if($lang==config('app.locale')){
        $product->default = $data ;
      }
      $product->save();
      
      // add product id to each category
      // TODO: test later to see what query method is fastest
      if(Input::has('categories')){
        $categories = Input::get('categories');
        foreach($categories as $category){
          $c = Category::find($category) ;
          $products = $c->products ;
          if(!empty($products)){
            array_push($products, $product->id) ;
            $c->products = array_unique($products) ;
          } else {
             $c->products = [$product->id] ;
          }
          $c->save() ;
        }
      }

      // redirect
      Session::flash('success',  trans('products.product').' '.trans('crud.created'));
      return Redirect::to('admin/products/' . $product->id . '/edit');
    }
  }
  
  /**
   * Edit a product
   *
   * @param string $id
   * 
   * @return Response
   */
  public function edit( $id )
  {
    $categories = $this->category_select() ;
    $product = Product::find($id) ; 
    $file_size = key(config('filesystems.image_sizes')) ;
    $files = $this->getFiles('images/products/'.$product->id.'/'.$file_size);
    return view('admin/products/edit', ['product' => $product, 'categories' => $categories, 'files' => $files, 'file_size' => $file_size]);
  }
  
  /**
   * Update a product
   *
   * @param string $id
   * 
   * @return Redirect
   */
  public function update( $id )
  {
    // validate
    $rules = [
      'name'       => 'required'
    ];
    $validator = Validator::make(Input::all(), $rules);
    if ($validator->fails()) {
      return Redirect::to('admin/products/' . $id . '/edit')
        ->withErrors($validator)
        ->withInput();
    } else {
      // store
      $lang = Session::get('language');
      $product = Product::find($id);
      $product->shop_id = Input::get('shop_id');
      $product->slug = Input::get('slug');
      $product->categories = Input::get('categories');
      $product->price = Input::get('price');
      $product->rrp = Input::get('rrp');
      $product->salePrice = Input::get('salePrice');
      $data = Input::except(['shop_id', 'categories', 'slug', '_token', '_method', 'price', 'rrp', 'salePrice']) ;
      $product->$lang = $data ;
      if($lang==config('app.locale')){
        $product->default = $data ;
      }
      $product->save();
      
      // add product id to each category
      // TODO: test later to see what query method is fastest
      if(Input::has('categories')){
        $categories = Input::get('categories');
        foreach($categories as $category){
          $c = Category::find($category) ;
          $products = $c->products ;
          if(!empty($products)){
            array_push($products, $product->id) ;
            $c->products = array_unique($products) ;
          } else {
             $c->products = [$product->id] ;
          }
          $c->save() ;
        }
      }

      // redirect
      Session::flash('success', trans('products.product').' '.trans('crud.updated'));
      return Redirect::to('admin/products/' . $id . '/edit');
    }
  }
  
  /**
   * Delete a product
   *
   * @param string $id
   * 
   * @return Redirect
   */
  public function destroy( $id )
  {
    // delete
    $product = Product::find($id);      
    $product->delete();

    // redirect
    Session::flash('success',  trans('products.product').' '.trans('crud.deleted'));
    return Redirect::to('admin/products');
  }
}