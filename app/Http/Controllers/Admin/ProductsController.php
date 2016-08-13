<?php

namespace App\Http\Controllers\Admin;
use App\Models\Product;
use App\Models\Category;
use App\Http\Traits\CategoriesTrait;
use Validator ;
use Input ;
use Session ;
use Redirect ;

class ProductsController extends AdminController
{
  use CategoriesTrait ;
  
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
    $products = Product::where('shop_id', '=', Session::get('shop'))->get();
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
    return view('admin/products/edit', ['product' => $product, 'categories' => $categories]);
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