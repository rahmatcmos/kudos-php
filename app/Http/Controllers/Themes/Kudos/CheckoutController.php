<?php
namespace App\Http\Controllers\Themes\Kudos;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Address;
use Illuminate\Support\Facades\Auth;
use Omnipay ;
use App\Notifications\NewOrder;

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
    return view('themes/kudos/checkout/index', ['addresses' => $addresses]);
  }
  
  /**
   * Take Payment
   *
   * @return Response
   */
  public function store(Request $request)
  {
    // check for address
    if(!$request->shipping_id || !$request->billing_id){
      $request->session()->flash('danger',  trans('address.required')) ;
      return back() ;
    }
    
    
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
      // create order and send email
      $order = $this->createOrder($request) ;
      $request->session()->forget('basket') ;
      $request->session()->flash('success',  trans('orders.thankyou'));
      Auth::user()->notify(new NewOrder($order));
      return redirect('/account');
    } else {
      // payment failed: display message to customer
      $request->session()->flash('danger',  $response->getMessage()) ;
      return redirect('/checkout');
    }
  }
  
  public function createOrder(Request $request)
  { 
      // get the basket
      $basket = $request->session()->get('basket') ;
      
      // save order
      $order = new Order;
      $order->shop_id = $request->session()->get('shop') ;
      $order->customer_id = Auth::user()->id ;
      $order->currency = $request->session()->get('currency') ;
      $order->shipping_id = $request->shipping_id ;
      $order->billing_id = $request->billing_id ;
      $order->total = $basket['subtotal'];
      $basket['shipping'] = Address::find($request->shipping_id)->toArray() ;
      $basket['billing'] = Address::find($request->billing_id)->toArray() ;
      $order->basket = $basket;
      $order->save();
      return $order ;
  }

}