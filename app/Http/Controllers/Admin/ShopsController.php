<?php

namespace App\Http\Controllers\Admin;
use App\Models\Shop;
use Validator ;
use Input ;
use Session ;
use Redirect ;

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
  public function store(  )
  {
    // validate
    $rules = [
      'name'       => 'required'
    ];
    $validator = Validator::make(Input::all(), $rules);
    if ($validator->fails()) {
      return Redirect::to('shops/create')
        ->withErrors($validator)
        ->withInput();
    } else {
      // store
      $lang = Session::get('language');
      $shop = new Shop;
      $data = [
        'name' => Input::get('name')
      ];
      $shop->$lang = $data ;
      if($lang==config('app.locale')){
        $shop->default = $data ;
      }
      $shop->save();

      // redirect
      Session::flash('success',  trans('shops.shop').' '.trans('crud.created'));
      return Redirect::to('admin/shops/' . $shop->id . '/edit');
    }
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
    return view('admin/shops/edit', ['shop' => $shop]);
  }
  
  /**
   * Update a shop
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
      return Redirect::to('admin/shops/' . $id . '/edit')
        ->withErrors($validator)
        ->withInput();
    } else {
      // store
      $lang = Session::get('language');
      $shop = Shop::find($id);
      $data = [
        'name' => Input::get('name')
      ];
      $shop->$lang = $data ;
      if($lang==config('app.locale')){
        $shop->default = $data ;
      }
      $shop->save();

      // redirect
      Session::flash('success', trans('shops.shop').' '.trans('crud.updated'));
      return Redirect::to('admin/shops/' . $id . '/edit');
    }
  }
  
  /**
   * Delete a shop
   *
   * @param string $id
   * 
   * @return Redirect
   */
  public function destroy( $id )
  {
    // delete
    $shop = Shop::find($id);      
    $shop->delete();

    // redirect
    Session::flash('success',  trans('shops.shop').' '.trans('crud.deleted'));
    return Redirect::to('admin/shops');
  }
}