<?php
namespace App\Models;
use Moloquent ;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class Category extends Moloquent {
  
  use SoftDeletes;
  
  protected $connection = 'mongodb';
  
  /**
   * allow filling of any amount of fields
   */
  protected $guarded = [];
  
}