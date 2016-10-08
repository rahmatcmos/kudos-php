<?php
namespace App\Models;

use Moloquent ;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class Order extends Moloquent {
  
  use SoftDeletes;
  
  protected $connection = 'mongodb';
  
  /**
  * Get the order Items for the order.
  */
  public function items()
  {
    return $this->hasMany('App\Models\OrderItem');
  }
  
}