<?php
namespace App\Models;

use Moloquent ;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class Blog extends Moloquent {
  
  use SoftDeletes;
  
  /**
   * allow filling of any amount of fields
   */
  protected $guarded = [];
  
}