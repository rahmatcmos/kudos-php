<?php

namespace App\Http\Controllers\Admin;
use App\Models\Product;
use App\Models\Category;
use App\Http\Traits\Media;

class PopulateController extends AdminController
{
  use Media ;
  
  public function index()
  {
    echo 'hello' ;
  }
  
 }