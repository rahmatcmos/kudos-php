<?php
namespace App\Models;

use Moloquent;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;
use App\Models\Currency;

class Product extends Moloquent {
  
  use SoftDeletes;

  protected $dates = ['deleted_at'];
  
  /**
   * allow filling of any amount of fields
   */
  protected $guarded = [];
  
  /**
   * mutator for price @ currency rate
   */
  public function getPriceAttribute($value)
  {
    $currency = new Currency ;
    return number_format($value * $currency->rate, 2) ;
  }
  
  /**
   * mutator for sale price @ currency rate
   */
  public function getSalePriceAttribute($value)
  {
    $currency = new Currency ;
    return number_format($value * $currency->rate, 2) ;
  }
  
  /**
   * mutator for rrp @ currency rate
   */
  public function getRrpAttribute($value)
  {
    $currency = new Currency ;
    return number_format($value * $currency->rate, 2) ;
  }
  
}