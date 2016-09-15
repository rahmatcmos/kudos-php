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
    $qtyRange = range(0,10) ;
    unset($qtyRange[0]) ;
    return view('themes/basic/basket/index', ['subtotal' => $subtotal, 'qtyRange' => $qtyRange]);
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
   * @param string $id
   *
   * @return Redirect
   */
  public function destroy($id)
  {
    $basket = Session::get('basket') ;
    unset($basket[$id]) ;
    Session::put('basket', $basket) ;
    return Redirect::to('basket');
  }
  
  /**
   * update Quantity
   *
   * @param string $id
   *
   * @return Redirect
   */
  public function update($id)
  {
    $basket = Session::get('basket') ;
    $basket[$id]['qty'] = Input::get('qty') ;
    Session::put('basket', $basket) ;
    return Redirect::to('basket');
  }

}