<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use App\Models\Shop;
use App\Models\Language;

class AdminController extends \App\Http\Controllers\Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    public function __construct()
    {
      $this->middleware(function ($request, $next){
        
        // get all shops
        $shops = Shop::all() ;
        
        // if there are no shops force user to add one
        if(count($shops) == 0){
          $request->session()->flash('warning',  trans('shops.required'));
          return redirect('shops/create');
        }
        
        // if session is not set or the shop doesn't exist reset the session for the shop
        if ( !$request->session()->has('shop') || Shop::where('_id', '=', $request->session()->get('shop'))->count()==0 ){
          $shop = Shop::first() ;
          $request->session()->put('shop', $shop->id) ;
          $request->session()->put('shop_url', $shop->url) ;
        }
        
        // if session is not set reset the session for the language
        if ( !$request->session()->has('language')){
          $request->session()->put('language', config('app.locale')) ;
        }
        
        // if limit is not set default pagination limit
        if ( !$request->session()->has('limit')){
          $request->session()->put('limit', 100) ;
        }
        
        view()->share('select_shops', $shops);
        view()->share('languages', Language::LANGUAGES);
        view()->share('language', $request->session()->get('language')) ;
           
        return $next($request);
      }) ;
    }
    
    public function login()
    {  
      if ( Auth::check() && Auth::user()->isAdmin() )
        return redirect('admin/dashboard') ;
      return view('auth/admin-login');
    }
}