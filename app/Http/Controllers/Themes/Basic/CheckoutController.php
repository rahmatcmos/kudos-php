<?php

namespace App\Http\Controllers\Themes\Basic;
use Session ;

class CheckoutController extends ThemeController
{

  /**
   * Checkout
   *
   * @return Response
   */
  public function index()
  {
    return view('themes/basic/checkout/index');
  }

}