<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Shop;

class DashboardController extends AdminController
{  
    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function show(Request $request)
    {
      return view('admin/dashboard');
    }
    
    public function remember(Request $request)
    {
      // toggle state 
      if( $request->has('toggled') )  $request->session()->put('toggled', $request->toggled );
      
      // toggle shop 
      if( $request->has('shop') ){
        $shop = Shop::find($request->shop) ;
        $request->session()->put('shop', $shop->id );
        $request->session()->put('shop_url', $shop->url );
      }
      
      // toggle language 
      if( $request->has('language') )  $request->session()->put('language', $request->language );
      
    }
}