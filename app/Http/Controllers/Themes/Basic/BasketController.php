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
    // set subtotal/count
    $this->totals() ;
    $qtyRange = range(0,10) ;
    unset($qtyRange[0]) ;
    return view('themes/basic/basket/index', ['subtotal' => Session::get('basket')['subtotal'], 'qtyRange' => $qtyRange]);
  }
  
  /**
   * Add to Basket
   *
   * @return Redirect
   */
  public function store()
  {
    $basket = Session::get('basket') ;
    if(isset($basket['items'][Input::get('id')])){
      $basket['items'][Input::get('id')]['qty']++ ;
    } else {
      $basket['items'][Input::get('id')] = [
        'price' => Input::get('price'),
        'qty'   => 1,
        'product' => Product::find(Input::get('id'))->toArray()
      ] ;
    }
    Session::put('basket', $basket) ;
    $this->totals() ;
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
    unset($basket['items'][$id]) ;
    Session::put('basket', $basket) ;
    $this->totals() ;
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
    $basket['items'][$id]['qty'] = Input::get('qty') ;
    Session::put('basket', $basket) ;
    $this->totals() ;
    return Redirect::to('basket');
  }
  
  /**
   * update totals/count
   *
   * @return
   */
  public function totals()
  {
    $basket = Session::get('basket') ;
    $subtotal = 0 ;
    $count = 0 ;
    foreach($basket['items'] as $id => $item){
      $subtotal += $item['qty'] * $item['price'] ; 
      $count += $item['qty'] ; 
    }
    Session::put('basket.count', $count) ;
    Session::put('basket.subtotal', $subtotal) ;
    return ;
  }

}