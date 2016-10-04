<?php
namespace App\Http\Controllers\Admin;

use App\Models\Blog;
use App\Http\Traits\Media;

class BlogController extends AdminController
{
  use Media ;
  
   /**
   * List all blog
   *
   * @return Response
   */
  public function index(Request $request)
  {
    // pagination
    $session_type = 'blog' ;
    if (!$request->session()->has('order_by')) $request->session()->put($session_type.'.order_by', 'created_at') ;
    if (!$request->session()->has('order_dir')) $request->session()->put($session_type.'.order_dir', 'desc') ;
    if ($request->order_by) $request->session()->put($session_type.'.order_by', $request->order_by) ;
    if ($request->order_dir) $request->session()->put($session_type.'.order_dir', $request->order_dir) ;
    
    $limit = $request->session()->get('limit') ;
    $orderby = $request->session()->get($session_type.'.order_by') == 'created_at'
      ? $request->session()->get($session_type.'.order_by')
      : $request->session()->get('language').'.'.$request->session()->get($session_type.'.order_by') ;
      
    $blog = Blog::where('shop_id', '=', $request->session()->get('shop'))
      ->where(function($query) {
        if ($request->search){
          
          return $query->where('en.name', 'LIKE', '%'.$request->search.'%') ;
        }
        return ;
      })
      ->orderBy($orderby, $request->session()->get($session_type.'.order_dir'))
      ->paginate($limit);
    $blog->search = $request->search ;
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
  public function store(Request $request)
  {
    // store
    $lang = $request->session()->get('language');
    $blog = new Blog;
    $blog->shop_id = $request->shop_id;
    $blog->slug = $request->slug;
    $data = $request->except(['shop_id', 'slug', '_token', '_method']) ;
    $blog->$lang = $data ;
    if($lang==config('app.locale')){
      $blog->default = $data ;
    }
    $blog->save();

    // redirect
    $request->session()->flash('success',  trans('blog.blog').' '.trans('crud.created'));
    return redirect('admin/blog/' . $blog->id . '/edit');
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
    $file_size = key(config('image.image_sizes')) ;
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
  public function update(Request $request, $id)
  {
    // store
    $lang = $request->session()->get('language');
    $blog = Blog::find($id);
    $blog->shop_id = $request->shop_id;
    $blog->slug = $request->slug;
    $data = $request->except(['shop_id', 'slug', '_token', '_method']) ;
    $blog->$lang = $data ;
    if($lang==config('app.locale')){
      $blog->default = $data ;
    }
    $blog->save();

    // redirect
    $request->session()->flash('success', trans('blog.blog').' '.trans('crud.updated'));
    return redirect('admin/blog/' . $id . '/edit');
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
    $request->session()->flash('success',  trans('blog.blog').' '.trans('crud.deleted'));
    return redirect('admin/blog');
  }
}