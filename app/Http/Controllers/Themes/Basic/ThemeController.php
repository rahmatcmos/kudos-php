<?php

namespace App\Http\Controllers\Themes\Basic;
use App\Models\Shop;
use App\Models\Category;
use Session ;

class ThemeController extends \App\Http\Controllers\Controller
{
    
    public function __construct()
    {    
      // if session is not set or the shop doesn't exist reset the session for the shop
      if ( !Session::has('shop') || Shop::where('_id', '=', Session::get('shop'))->count()==0 ){
        $shop = Shop::first() ;
        Session::put('shop', $shop->id) ;
      }
      
      // if session is not set reset the session for the language
      if ( !Session::has('language')){
        Session::put('language', config('app.locale')) ;
      }
      
      // if session is not set reset the session for the basket
      if ( !Session::has('basket')){
        Session::put('basket', []) ;
      }
      
      // share basket count/total for header
      $subtotal = 0 ;
      $count = 0 ;
      if(!empty(Session::get('basket'))){
        foreach(Session::get('basket') as $id => $item){
          $subtotal += $item['qty'] * $item['price'] ; 
          $count += $item['qty'] ;
        }
        Session::put('basketCount', $count) ;
        Session::put('basketSubtotal', $subtotal) ;
      }
      
      $categories = Category::where('shop_id', Session::get('shop'))->orderBy('order', 'asc')->get() ;
    
      view()->share('language', Session::get('language')) ;
      view()->share('categories', $categories) ;
    }

}
