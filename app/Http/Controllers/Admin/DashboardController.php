<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Category;
use App\Models\Product;
use App\Models\Page;
use App\Models\Blog;
use App\Models\Order;
use App\User;

class DashboardController extends AdminController
{  
    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function show(Request $request)
    {
      $stats['categories'] = Category::where('shop_id', '=', $request->session()->get('shop'))->count() ;
      $stats['products'] = Product::where('shop_id', '=', $request->session()->get('shop'))->count() ;
      $stats['customers'] = User::where('shop_id', '=', $request->session()->get('shop'))->count() ;
      $stats['pages'] = Page::where('shop_id', '=', $request->session()->get('shop'))->count() ;
      $stats['blogs'] = Blog::where('shop_id', '=', $request->session()->get('shop'))->count() ;
      $stats['orders'] = Order::where('shop_id', '=', $request->session()->get('shop'))->count() ;
      $stats['revenue'] = Order::where('shop_id', '=', $request->session()->get('shop'))->sum('total') ;
      return view('admin/dashboard', ['stats' => $stats]);
    }
    
    /**
     * remember lang/shop state
     */
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