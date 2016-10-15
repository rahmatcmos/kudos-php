<?php
namespace App\Http\Controllers\Themes\Kudos;

use Illuminate\Http\Request;
use App\Models\Currency;

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
    return redirect()->back() ;
  }
}