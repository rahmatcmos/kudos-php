<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Support\Facades\Auth;
use App\Models\Shop;
use App\Models\Language;
use Redirect ;
use Session ;

class AdminController extends \App\Http\Controllers\Controller
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;
    
    public function __construct()
    {
      // get all shops
      $shops = Shop::all() ;
    
      // if there are no shops force user to add one
      if(count($shops) == 0){
        Session::flash('warning',  trans('shops.required'));
        return Redirect::to('shops/create');
      }
      
      // if session is not set or the shop doesn't exist reset the session for the shop
      if ( !Session::has('shop') || Shop::where('_id', '=', Session::get('shop'))->count()==0 ){
        $shop = Shop::first() ;
        Session::put('shop', $shop->id) ;
        Session::put('shop_url', $shop->url) ;
      }
      
      // if session is not set reset the session for the language
      if ( !Session::has('language')){
        Session::put('language', config('app.locale')) ;
      }
      
      // if limit is not set default pagination limit
      if ( !Session::has('limit')){
        Session::put('limit', 100) ;
      }
      
      view()->share('select_shops', $shops);
      view()->share('languages', Language::LANGUAGES);
      view()->share('language', Session::get('language')) ;
    }
    
    public function login()
    {  
      if ( Auth::check() && Auth::user()->isAdmin() )
        return Redirect::to('admin/dashboard') ;
      return view('auth/admin-login');
    }
}
