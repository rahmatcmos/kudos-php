<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Http\Traits\CategoriesTrait;
use App\Http\Traits\Media;

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
  public function index(Request $request)
  {
    // pagination
    $session_type = 'product' ;
    if (!$request->session()->has('order_by')) $request->session()->put($session_type.'.order_by', 'created_at') ;
    if (!$request->session()->has('order_dir')) $request->session()->put($session_type.'.order_dir', 'desc') ;
    if ($request->order_by) $request->session()->put($session_type.'.order_by',$request->order_by) ;
    if ($request->order_dir) $request->session()->put($session_type.'.order_dir',$request->order_dir) ;
    
    $limit = $request->session()->get('limit') ;
    $orderby = $request->session()->get($session_type.'.order_by') == 'created_at'
      ? $request->session()->get($session_type.'.order_by')
      : $request->session()->get('language').'.'.$request->session()->get($session_type.'.order_by') ;
      
    // query products with conditional search  
    $products = Product::where('shop_id',$request->session()->get('shop'))
      ->where(function($query) use ($request) {
        if ($request->search) {
          return $query->where('en.name', 'LIKE', '%'.$request->search.'%') ;
        }
        return ;
      })
      ->orderBy($orderby, $request->session()->get($session_type.'.order_dir'))
      ->paginate($limit);
    $products->search = $request->search ;
    return view('admin/products/index', ['products' => $products]);
  }
  
  /**
   * Create a product
   *
   * @return Response
   */
  public function create(Request $request)
  {
    $categories = $this->category_select($request) ;
    return view('admin/products/create', ['categories' => $categories]);
  }
  
  /**
   * Save a product
   * 
   * @return Redirect
   */
  public function store(Request $request)
  {
    // store
    $lang = $request->session()->get('language');
    $product = new Product;
    $product->shop_id = $request->shop_id;
    $product->slug = $request->slug;
    $product->categories = $request->categories;
    $product->price = $request->price;
    $product->rrp = $request->rrp;
    $product->salePrice = $request->salePrice;
    $data = $request->except(['shop_id', 'categories', 'slug', '_token', '_method', 'price', 'rrp', 'salePrice']) ;
    $product->$lang = $data ;
    if($lang==config('app.locale')){
      $product->default = $data ;
    }
    $product->save();
    
    // add product id to each category
    if($request->has('categories')){
      $categories = $request->categories;
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
    $request->session()->flash('success',  trans('products.product').' '.trans('crud.created'));
    return redirect('admin/products/' . $product->id . '/edit');
  }
  
  /**
   * Edit a product
   *
   * @param string $id
   * 
   * @return Response
   */
  public function edit(Request $request, $id)
  {
    $categories = $this->category_select($request) ;
    $product = Product::find($id) ; 
    $file_size = key(config('image.image_sizes')) ;
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
  public function update(Request $request, $id)
  {
    // store
    $lang = $request->session()->get('language');
    $product = Product::find($id);
    $product->shop_id = $request->shop_id;
    $product->slug = $request->slug;
    $product->categories = $request->categories;
    $product->price = $request->price;
    $product->rrp = $request->rrp;
    $product->salePrice = $request->salePrice;
    $data = $request->except(['shop_id', 'categories', 'slug', '_token', '_method', 'price', 'rrp', 'salePrice']) ;
    $product->$lang = $data ;
    if($lang==config('app.locale')){
      $product->default = $data ;
    }
    $product->save();
    
    // add product id to each category
    if($request->has('categories')){
      $categories = $request->categories;
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
    $request->session()->flash('success', trans('products.product').' '.trans('crud.updated'));
    return redirect('admin/products/' . $id . '/edit');
  }
  
  /**
   * Delete a product
   *
   * @param string $id
   * 
   * @return Redirect
   */
  public function destroy(Request $request, $id )
  {
    // delete
    $product = Product::find($id);      
    $product->delete();

    // redirect
    $request->session()->flash('success',  trans('products.product').' '.trans('crud.deleted'));
    return redirect('admin/products');
  }
}