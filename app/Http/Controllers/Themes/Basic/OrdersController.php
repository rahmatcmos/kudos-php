<?php

namespace App\Http\Controllers\Themes\Basic;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Session ;

class OrdersController extends ThemeController
{

  /**
   * List all orders
   *
   * @return Response
   */
  public function index()
  {
    $limit = Session::get('limit') ;
    $orders = Order::where('customer_id', Auth::user()->id)
      ->paginate($limit);
    return view('themes/basic/orders/index', ['orders' => $orders]);
  }
  
  /**
   * order details
   *
   * @return Response
   */
  public function show($id)
  {
    $order = Order::find($id);
    if(!$order) \App::abort(404);
    $items = OrderItem::where('order_id', $order->id)->get();
    $order_items = [];
    foreach($items as $item){
      $order_items[$item->product_id] = Product::find($item->product_id) ; 
      $order_items[$item->product_id]['price'] = $item->price ;
      $order_items[$item->product_id]['qty'] = $item->quantity ;
    }
    return view('themes/basic/orders/show', ['order' => $order, 'order_items' => $order_items]);
  }

}