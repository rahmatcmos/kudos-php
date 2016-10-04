<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderItem extends Model {

  public $timestamps = false;
  
  /**
   * Get the order record associated with the line-item.
   */
  public function order()
  {
    return $this->hasOne('App\Models\Order');
  }
}