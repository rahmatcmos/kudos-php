<?php
namespace App\Http\Traits;

use Illuminate\Http\Request;
use App\Models\Category;

trait CategoriesTrait
{
    
  /*
   * get categories for select
   *
   * $return array
   */
  public function category_select(Request $request)
  {
    $lang = $request->session()->get('language');
    $categories = [] ;
    $results = Category::where('shop_id', '=', $request->session()->get('shop'))->get() ; 
    foreach($results as $category)
    {
      $categories[$category->id] = isset($category->$lang['name']) ? $category->$lang['name'] : $category->default['name'] ; 
    }
    return $categories ;
  }
  
}