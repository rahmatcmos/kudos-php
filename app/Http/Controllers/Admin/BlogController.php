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
    $blog = Blog::where('shop_id', '=', Session::get('shop'))->get() ;
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
    $files = $this->getFiles('images/blogs/'.$blog->id.'/'.key(config('filesystems.image_sizes')));
    return view('admin/blog/edit', ['blog' => $blog, 'files' => $files]);
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