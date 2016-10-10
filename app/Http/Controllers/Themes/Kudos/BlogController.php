<?php
namespace App\Http\Controllers\Themes\Kudos;

use Illuminate\Http\Request;
use App\Models\Blog;

class BlogController extends ThemeController
{

  /**
   * List all articles
   *
   * @return Response
   */
  public function index(Request $request)
  {
    $blogs = Blog::where('shop_id', $request->session()->get('shop'))->paginate(20) ;
    return view('themes/kudos/blog/index', ['blogs' => $blogs]);
  }
  
  /**
   * Show article
   *
   * @return Response
   */
  public function show($slug)
  {
    $blog = Blog::where('slug', $slug)->first() ;
    if(!$blog) \App::abort(404);
    return view('themes/kudos/blog/show', ['blog' => $blog]);
  }

}