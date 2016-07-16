<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model {
  
  use SoftDeletes;
  
  /**
     * The table associated with the model.
     *
     * @var string
     */
  protected $table = 'addresses';
  
  /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
  protected $fillable = [
    'customer_id',
    'address1',
    'address2',
    'address3',
    'town',
    'county',
    'postcode',
    'country'
  ];
  
}