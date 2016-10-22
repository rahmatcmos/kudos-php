<?php
namespace App\Models;

use Moloquent ;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;
use Session ;

class Page extends Moloquent {
  
  use SoftDeletes;
  
  /**
   * allow filling of any amount of fields
   */
  protected $guarded = [];
  
  /**
   * accessor for page name
   */
  public function getNameAttribute($value)
  {
    $language = Session::get('language') ;
    if(isset($this->$language['name']))
      return $this->$language['name'] ;
    return $this->default['name'] ;
  }
  
  /**
   * accessor for page content 
   */
  public function getContentAttribute($value)
  {
    $language = Session::get('language') ;
    if(isset($this->$language['content']))
      return $this->$language['content'] ;
    return $this->default['content'] ;
  }

}