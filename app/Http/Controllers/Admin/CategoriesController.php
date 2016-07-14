<?php

namespace App\Http\Controllers\Admin;
use App\Models\Category;
use Validator ;
use Input ;
use Session ;
use Redirect ;

class CategoriesController extends AdminController
{
  
  public function __construct()
  {
    parent::__construct() ;
    view()->share('body_class', 'categories');
  }
  
  /**
   * List all categories
   *
   * @return Response
   */
  public function index()
  {
    $categories = Category::where('shop_id', '=', Session::get('shop'))->orderBy('order', 'asc')->get() ;
    $categories = $this->sortCategories($categories->toArray()) ;
    return view('admin/categories/index', ['categories' => $categories]);
  }
  
  /*
   * sort categories
   *
   * @param array categories
   * @param string parent id
   * 
   * @return Response
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
  
  /*
   * save categories order
   *
   * @param array categories
   * 
   * @return bool
   */
  public function saveOrder()
  {
    $categories = Input::get('categories') ;
    array_shift($categories) ;
    $count = 0 ;
    foreach($categories as $category){
      Category::where('_id', $category['id'])->update(['parent' => $category['parent_id'], 'order' => $count++]) ;
    }
    return ;
  }
  
  /**
   * Create a category
   *
   * @return Response
   */
  public function create()
  {
    $categories = Category::where('shop_id', '=', Session::get('shop'))->orderBy('order', 'asc')->get() ;
    $categories = $this->sortCategories($categories->toArray()) ;
    return view('admin/categories/create', ['categories' => $categories]);
  }
  
  /**
   * Save a category
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
      return Redirect::to('admin/categories/create')
        ->withErrors($validator)
        ->withInput();
    } else {
      // store
      $lang = Session::get('language');
      $category = new category;
      $category->shop_id = Input::get('shop_id');
      $category->parent = Input::get('parent');
      $data = [
        'name' => Input::get('name')
      ];
      $category->$lang = $data ;
      if($lang==config('app.locale')){
        $category->default = $data ;
      }
      $category->save();

      // redirect
      Session::flash('success',  trans('categories.category').' '.trans('crud.created'));
      return Redirect::to('admin/categories/' . $category->id . '/edit');
    }
  }
  
  /**
   * Edit a category
   *
   * @param string $id
   * 
   * @return Response
   */
  public function edit( $id )
  {
    $categories = Category::where('shop_id', '=', Session::get('shop'))->orderBy('order', 'asc')->get() ;
    $categories = $this->sortCategories($categories->toArray()) ;
    $category = Category::find($id) ;
    return view('admin/categories/edit', ['category' => $category, 'categories' => $categories]);
  }
  
  /**
   * Update a category
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
      return Redirect::to('admin/categories/' . $id . '/edit')
        ->withErrors($validator)
        ->withInput();
    } else {
      // store
      $lang = Session::get('language');
      $category = Category::find($id);
      $category->shop_id = Input::get('shop_id');
      $category->parent = Input::get('parent');
      $data = [
        'name' => Input::get('name')
      ];
      $category->$lang = $data ;
      if($lang==config('app.locale')){
        $category->default = $data ;
      }
      $category->save();

      // redirect
      Session::flash('success', trans('categories.category').' '.trans('crud.updated'));
      return Redirect::to('admin/categories/' . $id . '/edit');
    }
  }
  
  /**
   * Delete a category
   *
   * @param string $id
   * 
   * @return Redirect
   */
  public function destroy( $id )
  {
    // delete
    $category = Category::find($id);      
    $category->delete();

    // redirect
    Session::flash('success',  trans('categories.category').' '.trans('crud.deleted'));
    return Redirect::to('admin/categories');
  }
}