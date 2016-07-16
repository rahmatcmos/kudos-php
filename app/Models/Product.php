<?php
namespace App\Models;
use Moloquent ;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class Product extends Moloquent {
  
  use SoftDeletes;
  
  protected $connection = 'mongodb';
  protected $dates = ['deleted_at'];
  
}