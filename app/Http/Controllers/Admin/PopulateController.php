<?php

namespace App\Http\Controllers\Admin;
use App\Models\Product;
use App\Models\Category;
use App\Http\Traits\Media;
use Lipsum ;

class PopulateController extends AdminController
{
  use Media ;
  
  public function index()
  {
    set_time_limit(0);
    ignore_user_abort(1);
    $shopId = '577e745ef04996236f4e5a52';
    for($i=1;$i<6;$i++){
      // create a category;
      $categoryProducts = [] ;
      $category = new Category;
      $category->shop_id = $shopId;
      $category->parent = 0;
      $category->slug = 'category-'.$i;
      $category->products = []; 
      $data = [
        'name' => 'Category '.$i,
        'content' => Lipsum::headers()->link()->ul()->html(5)
      ] ;
      $category->en = $data ; 
      $category->default = $data ;
      $category->save();
       
      // create products
      for($x=1;$x<200;$x++){
        // store
        $product = new Product;
        $product->shop_id = $shopId;
        $product->slug = 'product-'.$i;
        $product->categories = [$category->id];
        $product->price = number_format(rand(50, 275),2);
        $product->rrp = number_format($product->price * 1.2, 2);
        $product->salePrice = number_format($product->price * 0.8, 2);
        $data = [
          'name' => 'Product '.$i,
          'content' => Lipsum::headers()->link()->ul()->html(5),
          'excerpt' => Lipsum::short()->text(1)
        ] ;
        $product->en = $data ; 
        $product->default = $data ;      
        $product->save();
        $categoryProducts[] = $product->id ;
        app('App\Http\Controllers\Admin\MediaController')->generateImages( 'products', $product->id, 'http://unsplash.it/1600/900/?random' ) ;    
        $product->defaultImage = 'images/products/'.$product->id.'/large/image'.$product->id.'.jpg';    
        $product->save();
      }
      $category->products = $categoryProducts ;
      $category->save();
    }
  }
  
}