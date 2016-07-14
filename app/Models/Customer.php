<?php
namespace App\Models;
use Moloquent ;

class Customer extends Moloquent {
  
  protected $connection = 'mongodb';
}