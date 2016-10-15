<?php
namespace App\Http\Controllers\Themes\Kudos;

use Illuminate\Http\Request;
use App\Models\Currency;
use App\Models\Product;

class CurrenciesController extends ThemeController
{
  /**
   * Change the currency
   *
   * @return Redirect
   */
  public function show(Request $request, String $currency)
  {
    $request->session()->put('currency', $currency) ;
    $currency = Currency::where('currency', $currency)->first()->toArray() ;
    $request->session()->put('currency_rate', $currency['rate']) ;
    
    // we need to update the basket
    $basket = $request->session()->get('basket') ;
    foreach($basket['items'] as $id => $item){
      unset($basket['items'][$id]) ;
      $product = Product::find($id) ;
      $basket['items'][$id] = [
        'price' => !empty($product->salePrice) ? $product->salePrice : $product->price,
        'qty'   => $item['qty'],
        'product' => $product->toArray()
      ] ;
    }
    $request->session()->put('basket', $basket) ;
    
    return redirect()->back() ;
  }
}