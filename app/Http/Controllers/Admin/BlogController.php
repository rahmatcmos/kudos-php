<?php

namespace App\Http\Controllers\Admin;
use App\Models\Blog;
use App\Http\Traits\Media;
use Validator ;
use Input ;
use Session ;
use Redirect ;

class BlogController extends AdminController
{
  use Media ;
  
   /**
   * List all blog
   *
   * @return Response
   */
  public function index()
  {
    // pagination
    $session_type = 'blog' ;
    if (!Session::has('order_by')) Session::put($session_type.'.order_by', 'created_at') ;
    if (!Session::has('order_dir')) Session::put($session_type.'.order_dir', 'desc') ;
    if (Input::get('order_by')) Session::put($session_type.'.order_by', Input::get('order_by')) ;
    if (Input::get('order_dir')) Session::put($session_type.'.order_dir', Input::get('order_dir')) ;
    
    $limit = Session::get('limit') ;
    $orderby = Session::get($session_type.'.order_by') == 'created_at'
      ? Session::get($session_type.'.order_by')
      : Session::get('language').'.'.Session::get($session_type.'.order_by') ;
      
    $blog = Blog::where('shop_id', '=', Session::get('shop'))
      ->where(function($query) {
        if (Input::get('search')){
          
          return $query->where('en.name', 'LIKE', '%'.Input::get('search').'%') ;
        }
        return ;
      })
      ->orderBy($orderby, Session::get($session_type.'.order_dir'))
      ->paginate($limit);
    $blog->search = Input::get('search') ;
    return view('admin/blog/index', ['blog' => $blog]);
  }
  
  /**
   * Create a blog
   *
   * @return Response
   */
  public function create()
  {
    return view('admin/blog/create');
  }
  
  /**
   * Save a blog
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
      return Redirect::to('admin/blog/create')
        ->withErrors($validator)
        ->withInput();
    } else {
      // store
      $lang = Session::get('language');
      $blog = new Blog;
      $blog->shop_id = Input::get('shop_id');
      $blog->slug = Input::get('slug');
      $data = Input::except(['shop_id', 'slug', '_token', '_method']) ;
      $blog->$lang = $data ;
      if($lang==config('app.locale')){
        $blog->default = $data ;
      }
      $blog->save();

      // redirect
      Session::flash('success',  trans('blog.blog').' '.trans('crud.created'));
      return Redirect::to('admin/blog/' . $blog->id . '/edit');
    }
  }
  
  /**
   * Edit a blog
   *
   * @param string $id
   * 
   * @return Response
   */
  public function edit( $id )
  {
    $blog = Blog::find($id) ;
    $file_size = key(config('filesystems.image_sizes')) ;
    $files = $this->getFiles('images/blogs/'.$blog->id.'/'.$file_size);
    return view('admin/blog/edit', ['blog' => $blog, 'files' => $files, 'file_size' => $file_size]);
  }
  
  /**
   * Update a blog
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
      return Redirect::to('admin/blog/' . $id . '/edit')
        ->withErrors($validator)
        ->withInput();
    } else {
      // store
      $lang = Session::get('language');
      $blog = Blog::find($id);
      $blog->shop_id = Input::get('shop_id');
      $blog->slug = Input::get('slug');
      $data = Input::except(['shop_id', 'slug', '_token', '_method']) ;
      $blog->$lang = $data ;
      if($lang==config('app.locale')){
        $blog->default = $data ;
      }
      $blog->save();

      // redirect
      Session::flash('success', trans('blog.blog').' '.trans('crud.updated'));
      return Redirect::to('admin/blog/' . $id . '/edit');
    }
  }
  
  /**
   * Delete a blog
   *
   * @param string $id
   * 
   * @return Redirect
   */
  public function destroy( $id )
  {
    // delete
    $blog = Blog::find($id);      
    $blog->delete();

    // redirect
    Session::flash('success',  trans('blog.blog').' '.trans('crud.deleted'));
    return Redirect::to('admin/blog');
  }
}