<?php
namespace App\Http\Controllers\Themes\Basic;

use Illuminate\Routing\Route;
use App\Models\Shop;
use App\Models\Category;

class ThemeController extends \App\Http\Controllers\Controller
{
    
    public function __construct(Route $route)
    {    
      
      $this->middleware(function ($request, $next) {
        // if session is not set get it from .env SHOP_CODE
        if ( !$request->session()->has('shop')){
          $shop = Shop::where('code', config('app.shop_code'))->first() ;
          $request->session()->put('shop', $shop->id) ;
        }
        
        // if limit is not set default pagination limit
        if ( !$request->session()->has('limit')){
          $request->session()->put('limit', 100) ;
        }
        
        // if session is not set reset the session for the language
        if ( !$request->session()->has('language')){
          $request->session()->put('language', config('app.locale')) ;
        }
        
        // if session is not set reset the session for the basket
        if ( !$request->session()->has('basket')){
          $request->session()->put('basket', [
            'subtotal' => 0,
            'count' => 0,
            'items' => []
          ]) ;
        }

      
        // global list of categories
        $categories = Category::where('shop_id', $request->session()->get('shop'))->orderBy('order', 'asc')->get() ;
      
        // share globals
        view()->share('language', $request->session()->get('language')) ;
        view()->share('categories', $categories) ;
        
        return $next($request);
      
      }) ;
      
      // add controller & action to the body class
      $currentAction = $route->getActionName() ;
      list($controller, $method) = explode('@', $currentAction) ;
      $controller = preg_replace('/.*\\\/', '', $controller) ;
    	$action = preg_replace('/.*\\\/', '', $method) ;
      view()->share('body_class', $controller.'-'.$action);
    }

}
