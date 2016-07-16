<?php
namespace App\Models;
use Moloquent ;

class Page extends Moloquent {
  
  protected $connection = 'mongodb';
  
  /**
   * allow filling of any amount of fields
   */
  protected $guarded = [];
}