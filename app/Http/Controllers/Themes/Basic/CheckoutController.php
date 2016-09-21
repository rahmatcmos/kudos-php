<?php

namespace App\Http\Controllers\Themes\Basic;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Address;
use DB;
use Illuminate\Support\Facades\Auth;
use Input ;
use Session ;
use Omnipay ;
use Redirect ;

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
  public function store()
  {
    // charge the card
    $card = Omnipay::creditCard(Input::all());
    
    $response = Omnipay::purchase(
      [
        'amount' => number_format(Session::get('basket.subtotal'), 2),
        'currency' => 'GBP',
        'card' => $card
      ]
    )->send();

    if ($response->isSuccessful()) {
      // create order
      $this->createOrder(Input::all()) ;
      Session::forget('basket') ;
      Session::flash('success',  trans('order.thankyou'));
      return Redirect::to('/account');
    } else {
      // payment failed: display message to customer
      Session::flash('danger',  $response->getMessage()) ;
      return Redirect::to('/checkout');
    }
  }
  
  public function createOrder(Array $input)
  {
    DB::transaction(function ($input) use ($input){
      
      // get the basket
      $basket = Session::get('basket') ;
      
      // save order
      $order = new Order;
      $order->customer_id = Auth::user()->id ;
      $order->shipping_id = $input['shipping_id'] ;
      $order->billing_id = $input['billing_id'] ;
      $order->total = $basket['subtotal'];
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