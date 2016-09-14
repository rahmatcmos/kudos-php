<?php

namespace App\Http\Controllers\Themes\Basic;
use App\Models\Order;
use App\User;

class AccountController extends ThemeController
{

  /**
   * Account Dashboard
   *
   * @return Response
   */
  public function dashboard()
  {
    return view('themes/basic/account/dashboard');
  }

}