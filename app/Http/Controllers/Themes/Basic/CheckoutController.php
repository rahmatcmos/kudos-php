<?php
namespace App\Http\Controllers\Themes\Basic;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Address;
use Illuminate\Support\Facades\Auth;
use DB;
use Omnipay ;

class CheckoutController extends ThemeController
{

  /**
   * Checkout
   *
   * @return Response
   */
  public function index()
  {
    $addresses = Address::where('customer_id', Auth::user()->id)->get() ;
    return view('themes/basic/checkout/index', ['addresses' => $addresses]);
  }
  
  /**
   * Take Payment
   *
   * @return Response
   */
  public function store(Request $request)
  {
    // charge the card
    $card = Omnipay::creditCard($request->all());
    
    $response = Omnipay::purchase(
      [
        'amount' => number_format($request->session()->get('basket.subtotal'), 2),
        'currency' => 'GBP',
        'card' => $card
      ]
    )->send();

    if ($response->isSuccessful()) {
      // create order
      $this->createOrder($request->all()) ;
      $request->session()->forget('basket') ;
      $request->session()->flash('success',  trans('order.thankyou'));
      return redirect('/account');
    } else {
      // payment failed: display message to customer
      $request->session()->flash('danger',  $response->getMessage()) ;
      return redirect('/checkout');
    }
  }
  
  public function createOrder(Request $request, Array $input)
  {
    DB::transaction(function ($input) use ($input){
      
      // get the basket
      $basket = $request->session()->get('basket') ;
      
      // save order
      $order = new Order;
      $order->shop_id = $request->session()->get('shop') ;
      $order->customer_id = Auth::user()->id ;
      $order->shipping_id = $input['shipping_id'] ;
      $order->billing_id = $input['billing_id'] ;
      $order->total = $basket['subtotal'];
      $basket['shipping'] = Address::find($input['shipping_id'])->toArray() ;
      $basket['billing'] = Address::find($input['billing_id'])->toArray() ;
      $order->basket = serialize($basket);
      $order->save();
      
      // save order items
      foreach($basket['items'] as $id => $item){
        // save order
        $orderItem = new OrderItem;
        $orderItem->order_id = $order->id ;
        $orderItem->product_id = $id ;
        $orderItem->quantity = $item['qty'];
        $orderItem->price = $item['price'];
        $orderItem->save();
      }
    });
  }

}