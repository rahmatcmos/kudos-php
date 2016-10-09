<?php
namespace App\Models;

use Moloquent ;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class Order extends Moloquent {
  
  use SoftDeletes;
  
}