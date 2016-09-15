<?php

namespace App\Http\Controllers\Themes\Basic;
use Redirect ;
use App\Models\Product;
use Input ;
use Session ;

class BasketController extends ThemeController
{

  /**
   * View Basket
   *
   * @return Response
   */
  public function index()
  {
    // get subtotal
    $basket = Session::get('basket') ;
    $subtotal = 0 ;
    foreach($basket as $id => $item){
      $subtotal += $item['qty'] * $item['price'] ; 
    }
    return view('themes/basic/basket/index', ['subtotal' => $subtotal]);
  }
  
  /**
   * Add to Basket
   *
   * @return Redirect
   */
  public function store()
  {
    $basket = Session::get('basket') ;
    if(isset($basket[Input::get('id')])){
      $basket[Input::get('id')]['qty']++ ;
    } else {
      $basket[Input::get('id')] = [
        'price' => Input::get('price'),
        'qty'   => 1,
        'product' => Product::find(Input::get('id'))->toArray()
      ] ;
    }
    Session::put('basket', $basket) ;
    return Redirect::to('basket');
  }
  
  /**
   * remove from Basket
   *
   * @return Redirect
   */
  public function destroy()
  {
    $basket = Session::get('basket') ;
    unset($basket[Input::get('id')]) ;
    Session::put('basket', $basket) ;
    return Redirect::to('basket');
  }

}