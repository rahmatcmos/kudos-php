<?php

namespace App\Http\Controllers\Themes\Basic;
use App\Models\Blog;

class BlogController extends ThemeController
{

  /**
   * List all articles
   *
   * @return Response
   */
  public function index()
  {
    $blogs = Blog::all() ;
    return view('themes/basic/blog/index', ['blogs' => $blogs]);
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
    return view('themes/basic/blog/show', ['blog' => $blog]);
  }

}