<?php
namespace App\Http\Traits;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Option;

trait Options
{
  
  /**
   * return options baed on keys
   *
   * @param array $keys
   * 
   * @return array
   */
  public function getOptions(String $pid, String $key, Array $keys)
  {
    $product = Product::find($pid) ;
    $available = [] ;
    foreach($product->option_values as $option){
      $valid = true ;
      foreach($keys as $k => $v){
        // option doesn't exists
        if(!isset($option['options'][$k]) || $option['options'][$k]!=$v)
          $valid = false ;
      }
      if($valid) $available[] = $option['options'][$key] ;
    }
    return array_unique($available) ;
  }
  
}