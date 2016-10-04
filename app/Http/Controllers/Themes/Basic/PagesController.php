<?php
namespace App\Http\Controllers\Themes\Basic;

use App\Models\Page;

class PagesController extends ThemeController
{
  
  /**
   * Show Page
   *
   * @return Response
   */
  public function show($slug)
  {
    $page = Page::Where('slug', $slug)->first() ;
    if(!$page) \App::abort(404); 
    return view('themes/basic/pages/show', ['page' => $page]);
  }

}