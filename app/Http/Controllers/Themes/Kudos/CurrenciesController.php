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
    return redirect()->back() ;
  }
}