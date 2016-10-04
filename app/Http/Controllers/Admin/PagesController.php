<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Page;
use App\Http\Traits\Media;

class PagesController extends AdminController
{
  use Media ; 
  
  /**
   * List all pages
   *
   * @return Response
   */
  public function index(Request $request)
  {
    // pagination
    $session_type = 'page' ;
    if (!$request->session()->has('order_by')) $request->session()->put($session_type.'.order_by', 'created_at') ;
    if (!$request->session()->has('order_dir')) $request->session()->put($session_type.'.order_dir', 'desc') ;
    if ($request->order_by) $request->session()->put($session_type.'.order_by', $request->order_by) ;
    if ($request->order_dir) $request->session()->put($session_type.'.order_dir', $request->order_dir) ;
    
    $limit = $request->session()->get('limit') ;
    $orderby = $request->session()->get($session_type.'.order_by') == 'created_at'
      ? $request->session()->get($session_type.'.order_by')
      : $request->session()->get('language').'.'.$request->session()->get($session_type.'.order_by') ;
      
    $pages = Page::where('shop_id', $request->session()->get('shop'))
      ->where(function($query) {
        if ($request->search){
          
          return $query->where('en.name', 'LIKE', '%'.$request->search.'%') ;
        }
        return ;
      })
      ->orderBy($orderby, $request->session()->get($session_type.'.order_dir'))
      ->paginate($limit);
    $pages->search = $request->search ;
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
  public function store(Request $request)
  {
    // store
    $lang = $request->session()->get('language');
    $page = new Page;
    $page->shop_id = $request->shop_id;
    $page->slug = $request->slug;
    $data = $request->except(['shop_id', 'slug', '_token', '_method']) ;
    $page->$lang = $data ;
    if($lang==config('app.locale')){
      $page->default = $data ;
    }
    $page->save();

    // redirect
    $request->session()->flash('success',  trans('pages.page').' '.trans('crud.created'));
    return redirect('admin/pages/' . $page->id . '/edit');
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
    $file_size = key(config('image.image_sizes')) ;
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
  public function update(Request $request, $id)
  {
    // store
    $lang = $request->session()->get('language');
    $page = Page::find($id);
    $page->shop_id = $request->shop_id;
    $page->slug = $request->slug;
    $data = $request->except(['shop_id', 'slug', '_token', '_method']) ;
    $page->$lang = $data ;
    if($lang==config('app.locale')){
      $page->default = $data ;
    }
    $page->save();

    // redirect
    $request->session()->flash('success', trans('pages.page').' '.trans('crud.updated'));
    return redirect('admin/pages/' . $id . '/edit');
  }
  
  /**
   * Delete a page
   *
   * @param string $id
   * 
   * @return Redirect
   */
  public function destroy(Request $request, $id )
  {
    // delete
    $page = Page::find($id);      
    $page->delete();

    // redirect
    $request->session()->flash('success',  trans('pages.page').' '.trans('crud.deleted'));
    return redirect('admin/pages');
  }
}