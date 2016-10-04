<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Traits\Media;
use Storage ;

class CategoriesController extends AdminController
{
  
  use Media ;
  
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
  public function index(Request $request)
  {
    $categories = Category::where('shop_id', '=', $request->session()->get('shop'))->orderBy('order', 'asc')->get() ;
    $categories = $this->sortCategories($categories->toArray()) ;
    return view('admin/categories/index', ['categories' => $categories]);
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
  
  /*
   * save categories order
   *
   * @param array categories
   * 
   * @return bool
   */
  public function saveOrder()
  {
    $categories = $request->categories ;
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
  public function create(Request $request)
  {
    $categories = Category::where('shop_id', '=', $request->session()->get('shop'))->orderBy('order', 'asc')->get() ;
    $categories = $this->sortCategories($categories->toArray()) ;
    return view('admin/categories/create', ['categories' => $categories]);
  }
  
  /**
   * Save a category
   * 
   * @return Redirect
   */
  public function store(Request $request)
  {
    // store
    $lang = $request->session()->get('language');
    $category = new Category;
    $category->shop_id = $request->shop_id;
    $category->parent = $request->parent;
    $category->slug = $request->slug;
    $category->products = [];
    $data = $request->except(['shop_id', 'parent', 'slug', '_token', '_method']) ;      
    $category->$lang = $data ; 
    if($lang==config('app.locale')){
      $category->default = $data ;
    }
    $category->save();

    // redirect
    $request->session()->flash('success',  trans('categories.category').' '.trans('crud.created'));
    return redirect('admin/categories/' . $category->id . '/edit');
  }
  
  /**
   * Edit a category
   *
   * @param string $id
   * 
   * @return Response
   */
  public function edit(Request $request, $id)
  {
    $categories = Category::where('shop_id', '=', $request->session()->get('shop'))->orderBy('order', 'asc')->get() ;
    $categories = $this->sortCategories($categories->toArray()) ;
    $category = Category::find($id) ;
    $file_size = key(config('image.image_sizes')) ;
    $files = $this->getFiles('images/categories/'.$category->id.'/'.$file_size);
    return view('admin/categories/edit', ['category' => $category, 'categories' => $categories, 'files' => $files, 'file_size' => $file_size]);
  }
  
  /**
   * Update a category
   *
   * @param string $id
   * 
   * @return Redirect
   */
  public function update(Request $request, $id)
  {
    // store
    $lang = $request->session()->get('language');
    $category = Category::find($id);
    $category->shop_id = $request->shop_id;
    $category->parent = $request->parent;
    $category->slug = $request->slug;
    $data = $request->except(['shop_id', 'parent', 'slug', '_token', '_method']) ;
    unset($data['shop_id'], $data['parent']) ;
    $category->$lang = $data ;
    if($lang==config('app.locale')){
      $category->default = $data ;
    }
    $category->save();

    // redirect
    $request->session()->flash('success', trans('categories.category').' '.trans('crud.updated'));
    return redirect('admin/categories/' . $id . '/edit');
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
    $request->session()->flash('success',  trans('categories.category').' '.trans('crud.deleted'));
    return redirect('admin/categories');
  }
}