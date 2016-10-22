<?php
namespace App\Models;

use Moloquent ;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;
use Session ; 

class Category extends Moloquent {
  
  use SoftDeletes;
  
  /**
   * allow filling of any amount of fields
   */
  protected $guarded = [];
  
  /**
   * accessor for category name
   */
  public function getNameAttribute($value)
  {
    $language = Session::get('language') ;
    if(isset($this->$language['name']))
      return $this->$language['name'] ;
    return $this->default['name'] ;
  }
  
}