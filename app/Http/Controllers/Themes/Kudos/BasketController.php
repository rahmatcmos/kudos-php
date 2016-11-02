<?php
namespace App\Http\Controllers\Themes\Kudos;

use Illuminate\Http\Request;
use App\Models\Product;

class BasketController extends ThemeController
{

  /**
   * View Basket
   *
   * @return Response
   */
  public function index(Request $request)
  {
    // set subtotal/count
    $this->totals($request) ;
    $qtyRange = range(0,10) ;
    unset($qtyRange[0]) ;
    return view('themes/kudos/basket/index', ['subtotal' => $request->session()->get('basket')['subtotal'], 'qtyRange' => $qtyRange]);
  }
  
  /**
   * Add to Basket
   *
   * @return Redirect
   */
  public function store(Request $request)
  {
    $basket = $request->session()->get('basket') ;
    if(isset($basket['items'][$request->sku])){
      $basket['items'][$request->sku]['qty'] += $request->qty ;
    } else {
      $basket['items'][$request->sku] = [
        'price' => $request->price,
        'sku' => $request->sku,
        'option_sku' => $request->parent_sku,
        'qty'   => $request->qty,
        'product' => Product::find($request->id)->toArray()
      ] ;
    }
    $request->session()->put('basket', $basket) ;
    $this->totals($request) ;
    return redirect('basket');
  }
  
  /**
   * remove from Basket
   *
   * @param string $id
   *
   * @return Redirect
   */
  public function destroy(Request $request, $id)
  {
    $basket = $request->session()->get('basket') ;
    unset($basket['items'][$id]) ;
    $request->session()->put('basket', $basket) ;
    $this->totals($request) ;
    return redirect()->back();
  }
  
  /**
   * update Quantity
   *
   * @param string $id
   *
   * @return Redirect
   */
  public function update(Request $request, $id)
  {
    $basket = $request->session()->get('basket') ;
    $basket['items'][$id]['qty'] = $request->get('qty') ;
    $request->session()->put('basket', $basket) ;
    $this->totals($request) ;
    return redirect()->back();
  }
  
  /**
   * update totals/count
   *
   * @return
   */
  public function totals(Request $request)
  {
    $basket = $request->session()->get('basket') ;
    $subtotal = 0 ;
    $count = 0 ;
    foreach($basket['items'] as $id => $item){
      $subtotal += $item['qty'] * $item['price'] ; 
      $count += $item['qty'] ; 
    }
    $request->session()->put('basket.count', $count) ;
    $request->session()->put('basket.subtotal', $subtotal) ;
    return ;
  }

}