<?php

namespace App\Http\Controllers\Admin;
use App\Models\Page;
use App\Http\Traits\Media;
use Validator ;
use Input ;
use Session ;
use Redirect ;

class PagesController extends AdminController
{
  use Media ; 
  
  /**
   * List all pages
   *
   * @return Response
   */
  public function index()
  {
    // pagination
    $session_type = 'page' ;
    if (!Session::has('order_by')) Session::put($session_type.'.order_by', 'created_at') ;
    if (!Session::has('order_dir')) Session::put($session_type.'.order_dir', 'desc') ;
    if (Input::get('order_by')) Session::put($session_type.'.order_by', Input::get('order_by')) ;
    if (Input::get('order_dir')) Session::put($session_type.'.order_dir', Input::get('order_dir')) ;
    
    $limit = Session::get('limit') ;
    $orderby = Session::get($session_type.'.order_by') == 'created_at'
      ? Session::get($session_type.'.order_by')
      : Session::get('language').'.'.Session::get($session_type.'.order_by') ;
    $pages = Page::where('shop_id', '=', Session::get('shop'))
      ->orderBy($orderby, Session::get($session_type.'.order_dir'))
      ->paginate($limit);
    return view('admin/pages/index', ['pages' => $pages]);
  }
  
  /**
   * Create a page
   *
   * @return Response
   */
  public function create()
  {
    return view('admin/pages/create');
  }
  
  /**
   * Save a page
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
      return Redirect::to('admin/pages/create')
        ->withErrors($validator)
        ->withInput();
    } else {
      // store
      $lang = Session::get('language');
      $page = new Page;
      $page->shop_id = Input::get('shop_id');
      $page->slug = Input::get('slug');
      $data = Input::except(['shop_id', 'slug', '_token', '_method']) ;
      $page->$lang = $data ;
      if($lang==config('app.locale')){
        $page->default = $data ;
      }
      $page->save();

      // redirect
      Session::flash('success',  trans('pages.page').' '.trans('crud.created'));
      return Redirect::to('admin/pages/' . $page->id . '/edit');
    }
  }
  
  /**
   * Edit a page
   *
   * @param string $id
   * 
   * @return Response
   */
  public function edit( $id )
  {
    $page = Page::find($id) ;
    $file_size = key(config('filesystems.image_sizes')) ;
    $files = $this->getFiles('images/pages/'.$page->id.'/'.$file_size);
    return view('admin/pages/edit', ['page' => $page, 'files' => $files, 'file_size' => $file_size]);
  }
  
  /**
   * Update a page
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
      return Redirect::to('admin/pages/' . $id . '/edit')
        ->withErrors($validator)
        ->withInput();
    } else {
      // store
      $lang = Session::get('language');
      $page = Page::find($id);
      $page->shop_id = Input::get('shop_id');
      $page->slug = Input::get('slug');
      $data = Input::except(['shop_id', 'slug', '_token', '_method']) ;
      $page->$lang = $data ;
      if($lang==config('app.locale')){
        $page->default = $data ;
      }
      $page->save();

      // redirect
      Session::flash('success', trans('pages.page').' '.trans('crud.updated'));
      return Redirect::to('admin/pages/' . $id . '/edit');
    }
  }
  
  /**
   * Delete a page
   *
   * @param string $id
   * 
   * @return Redirect
   */
  public function destroy( $id )
  {
    // delete
    $page = Page::find($id);      
    $page->delete();

    // redirect
    Session::flash('success',  trans('pages.page').' '.trans('crud.deleted'));
    return Redirect::to('admin/pages');
  }
}