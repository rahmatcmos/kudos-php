<?php
namespace App\Http\Controllers\Admin;

use App\Models\Order ;
use Session ;
use Input ;

class OrdersController extends AdminController
{
    /**
     * List all orders
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      // pagination
      $session_type = 'order' ;
      if (!Session::has('order_by')) Session::put($session_type.'.order_by', 'created_at') ;
      if (!Session::has('order_dir')) Session::put($session_type.'.order_dir', 'desc') ;
      if (Input::get('order_by')) Session::put($session_type.'.order_by', Input::get('order_by')) ;
      if (Input::get('order_dir')) Session::put($session_type.'.order_dir', Input::get('order_dir')) ;
      
      $limit = Session::get('limit') ;
      $orders = Order::where('shop_id', '=', Session::get('shop'))
        ->where(function($query) {
          if (Input::get('search')){
            return $query->where('id', 'LIKE', '%'.Input::get('search').'%') ;
          }
          return ;
        })
        ->orderBy(Session::get($session_type.'.order_by'), Session::get($session_type.'.order_dir'))
        ->paginate($limit);
      $orders->search = Input::get('search') ;
      return view('admin/orders/index', ['orders' => $orders]);
    }
    
    /**
     * View an order
     *
     * @param Int $id 
     *
     * @return Response
     */
    public function show(Int $id)
    {  
        $order = Order::find($id) ;
        $order->basket = unserialize($order->basket) ;
        if(!$order) \App::abort(404);       
        return view('admin/orders/show', ['order' => $order]);
    }
}