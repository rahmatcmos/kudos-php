<?php
namespace App\Http\Traits;

use App\Models\Category;
use Session ;

trait CategoriesTrait
{
    
  /*
   * get categories for select
   *
   * $return array
   */
  public function category_select()
  {
    $lang = Session::get('language');
    $categories = [] ;
    $results = Category::where('shop_id', '=', Session::get('shop'))->get() ; 
    foreach($results as $category)
    {
      $categories[$category->id] = isset($category->$lang['name']) ? $category->$lang['name'] : $category->default['name'] ; 
    }
    return $categories ;
  }
  
}