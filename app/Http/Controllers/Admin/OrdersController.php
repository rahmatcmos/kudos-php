<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Order ;

class OrdersController extends AdminController
{
    /**
     * List all orders
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      // pagination
      $session_type = 'order' ;
      if (!$request->session()->has('order_by')) $request->session()->put($session_type.'.order_by', 'created_at') ;
      if (!$request->session()->has('order_dir')) $request->session()->put($session_type.'.order_dir', 'desc') ;
      if ($request->order_by) $request->session()->put($session_type.'.order_by', $request->order_by) ;
      if ($request->order_dir) $request->session()->put($session_type.'.order_dir', $request->order_dir) ;
      
      $limit = $request->session()->get('limit') ;
      $orders = Order::where('shop_id', '=', $request->session()->get('shop'))
        ->where(function($query) use ($request) {
          if ($request->search){
            return $query->where('id', 'LIKE', '%'.$request->search.'%') ;
          }
          return ;
        })
        ->orderBy($request->session()->get($session_type.'.order_by'), $request->session()->get($session_type.'.order_dir'))
        ->paginate($limit);
      $orders->search = $request->search ;
      return view('admin/orders/index', ['orders' => $orders]);
    }
    
    /**
     * View an order
     *
     * @param String $id 
     *
     * @return Response
     */
    public function show(String $id)
    {  
        $order = Order::find($id) ;
        $order->basket = unserialize($order->basket) ;
        if(!$order) \App::abort(404);       
        return view('admin/orders/show', ['order' => $order]);
    }
}