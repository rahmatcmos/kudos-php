<?php
namespace App\Models;

use Moloquent ;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class Product extends Moloquent {
  
  use SoftDeletes;

  protected $dates = ['deleted_at'];
  
  /**
   * allow filling of any amount of fields
   */
  protected $guarded = [];
  
}