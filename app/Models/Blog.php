<?php
namespace App\Models;
use Moloquent ;

class Blog extends Moloquent {
  
  protected $connection = 'mongodb';
  
  /**
   * allow filling of any amount of fields
   */
  protected $guarded = [];
  
}