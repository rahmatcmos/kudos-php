<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Category;

class ShopsController extends AdminController
{
  
  public function __construct()
  {
    parent::__construct() ;
    view()->share('shop_remove', true);
  }
  
  
  /**
   * List all shops
   *
   * @return Response
   */
  public function index()
  {
    $shops = Shop::all();
    return view('admin/shops/index', ['shops' => $shops]);
  }
  
  /**
   * Create a shop
   *
   * @return Response
   */
  public function create()
  {
    return view('admin/shops/create');
  }
  
  /**
   * Save a shop
   * 
   * @return Redirect
   */
  public function store(Request $request)
  {
    // store
    $lang = $request->session()->get('language');
    $shop = new Shop;
    $data = $request->except(['root', 'url','_token', '_method']) ;
    $shop->url = $request->url;
    $shop->$lang = $data ;
    if($lang==config('app.locale')){
      $shop->default = $data ;
    }
    $shop->save();

    // redirect
    $request->session()->flash('success',  trans('shops.shop').' '.trans('crud.created'));
    return redirect('admin/shops/' . $shop->id . '/edit');
  }
  
  /**
   * Edit a shop
   *
   * @param string $id
   * 
   * @return Response
   */
  public function edit( $id )
  {
    $shop = Shop::find($id) ;
    $categories = Category::where('shop_id', '=', $id)->orderBy('order', 'asc')->get() ;
    $categories = $this->sortCategories($categories->toArray()) ;
    return view('admin/shops/edit', ['shop' => $shop, 'categories' => $categories]);
  }
  
  /**
   * Update a shop
   *
   * @param string $id
   * 
   * @return Redirect
   */
  public function update(Request $request, $id)
  {
    // store
    $lang = $request->session()->get('language');
    $shop = Shop::find($id);
    $data = $request->except(['root', 'url','_token', '_method']) ;
    $shop->root = $request->root;
    $shop->url = $request->url;
    $shop->$lang = $data ;
    if($lang==config('app.locale')){
      $shop->default = $data ;
    }
    $shop->save();

    // redirect
    $request->session()->flash('success', trans('shops.shop').' '.trans('crud.updated'));
    return redirect('admin/shops/' . $id . '/edit');
  }
  
  /**
   * Delete a shop
   *
   * @param string $id
   * 
   * @return Redirect
   */
  public function destroy(Request $request, $id)
  {
    // delete
    $shop = Shop::find($id);      
    $shop->delete();

    // redirect
    $request->session()->flash('success',  trans('shops.shop').' '.trans('crud.deleted'));
    return redirect('admin/shops');
  }
  
  /*
   * sort categories
   *
   * @param array categories
   * @param string parent id
   * 
   * @return Array
   */
  private function sortCategories(Array $categories, $parent = NULL)
  {
    $return = [] ;
    foreach ($categories as $k => $v) {
      if ($v['parent'] == $parent) {
        $return[$v['_id']] = $v; 
        $return[$v['_id']]['children'] = $this->sortCategories($categories, $v['_id']);    
      }
    }
    return $return ;
  }
}