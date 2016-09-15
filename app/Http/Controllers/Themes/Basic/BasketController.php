<?php

namespace App\Http\Controllers\Themes\Basic;

class BasketController extends ThemeController
{

  /**
   * View Basket
   *
   * @return Response
   */
  public function index()
  {
    return view('themes/basic/basket/index');
  }

}