<?php
namespace App\Models;

use Moloquent;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;
use App\Models\Currency;
use App\Models\Language;
use Session ;

class Product extends Moloquent {
  
  use SoftDeletes;

  protected $dates = ['deleted_at'];
  
  /**
   * allow filling of any amount of fields
   */
  protected $guarded = [];
  
  /**
   * accessor for price @ currency rate
   */
  public function getPriceAttribute($value)
  {
    $currency = new Currency ;
    return number_format($value * $currency->currency_rate, 2, '.', '') ;
  }
  
  /**
   * accessor for sale price @ currency rate
   */
  public function getSalePriceAttribute($value)
  {
    $currency = new Currency ;
    return number_format($value * $currency->currency_rate, 2, '.', '') ;
  }
  
  /**
   * accessor for rrp @ currency rate
   */
  public function getRrpAttribute($value)
  {
    $currency = new Currency ;
    return number_format($value * $currency->currency_rate, 2, '.', '') ;
  }
  
  /**
   * accessor for product name
   */
  public function getNameAttribute($value)
  {
    $language = Session::get('language') ;
    if(isset($this->$language['name']))
      return $this->$language['name'] ;
    return $this->default['name'] ;
  }
  
  /**
   * accessor for content 
   */
  public function getContentAttribute($value)
  {
    $language = Session::get('language') ;
    if(isset($this->$language['content']))
      return $this->$language['content'] ;
    return $this->default['content'] ;
  }
  
  /**
   * accessor for excerpt
   */
  public function getExcerptAttribute($value)
  {
    $language = Session::get('language') ;
    if(isset($this->$language['excerpt']))
      return $this->$language['excerpt'] ;
    return $this->default['excerpt'] ;
  }
  
}