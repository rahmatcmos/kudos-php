<?php
namespace App\Http\Controllers\Themes\Kudos;

use Illuminate\Http\Request;
use App\Models\Language;

class LanguagesController extends ThemeController
{
  /**
   * Change the language
   *
   * @return Redirect
   */
  public function show(Request $request, String $language)
  {
    $request->session()->put('language', $language) ;
    return redirect()->back() ;
  }
}