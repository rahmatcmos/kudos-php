<?php
namespace App\Http\Controllers\Themes\Basic;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\Product;

class OrdersController extends ThemeController
{

  /**
   * List all orders
   *
   * @return Response
   */
  public function index(Request $request)
  {
    $limit = $request->session()->get('limit') ;
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
    return view('themes/basic/orders/show', ['order' => $order]);
  }

}