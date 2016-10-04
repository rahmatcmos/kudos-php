<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\User;
use App\Models\Address;
use App\Models\Order;

class CustomersController extends AdminController
{
  /**
   * List all customers
   *
   * @return Response
   */
  public function index(Request $request)
  {
    // pagination
    $session_type = 'customer' ;
    if (!$request->session()->has('order_by')) $request->session()->put($session_type.'.order_by', 'created_at') ;
    if (!$request->session()->has('order_dir')) $request->session()->put($session_type.'.order_dir', 'desc') ;
    if ($request->order_by) $request->session()->put($session_type.'.order_by', $request->order_by) ;
    if ($request->order_dir) $request->session()->put($session_type.'.order_dir', $request->order_dir) ;
    
    $limit = $request->session()->get('limit') ;
    $customers = User::where('shop_id', '=', $request->session()->get('shop'))
      ->where(function($query) use ($request) {
        if ($request->search){
          return $query->where('first_name', 'LIKE', '%'.$request->search.'%')
            ->orWhere('last_name', 'LIKE', '%'.$request->search.'%')
            ->orWhere('email', 'LIKE', '%'.$request->search.'%') ;
        }
        return ;
      })
      ->orderBy($request->session()->get($session_type.'.order_by'), $request->session()->get($session_type.'.order_dir'))
      ->paginate($limit);
    $customers->search = $request->search ;
    return view('admin/customers/index', ['customers' => $customers]);
  }
  
  /**
   * Create a customer
   *
   * @return Response
   */
  public function create()
  {
    return view('admin/customers/create');
  }
  
  /**
   * Save a customer
   * 
   * @return Redirect
   */
  public function store(Request $request)
  {
    // validate
    $this->validate($request, [
      'email' => 'required|email|unique:users',
    ]);

    // store
    $customer = new User;
    $customer->shop_id = $request->shop_id;
    $customer->first_name = $request->first_name ;    
    $customer->last_name = $request->last_name ;
    $customer->telephone = $request->telephone ;
    $customer->password = bcrypt(str_random(32)) ;
    $customer->email = $request->email ;
    $customer->save();

    // redirect
    $request->session()->flash('success',  trans('customers.customer').' '.trans('crud.created'));
    return redirect('admin/customers/' . $customer->id . '/edit');
  }
  
  /**
   * Edit a customer
   *
   * @param string $id
   * 
   * @return Response
   */
  public function edit( $id )
  {
    $customer = User::find($id) ;
    $addresses = Address::where('customer_id', '=', $customer->id)->get() ;
    $orders = Order::where('customer_id', '=', $customer->id)->get() ;
    return view('admin/customers/edit', ['customer' => $customer, 'addresses' => $addresses, 'orders' => $orders]);
  }
  
  /**
   * Update a customer
   *
   * @param string $id
   * 
   * @return Redirect
   */
  public function update(Request $request, $id)
  {
    // validate
    $this->validate($request, [
      'email' => 'required|email|unique:users,email,'.$id.',id'
    ]);

    // store
    $customer = User::find($id);
    $customer->shop_id = $request->shop_id;
    $customer->first_name = $request->first_name ;    
    $customer->last_name = $request->last_name ;
    $customer->telephone = $request->telephone ;
    $customer->email = $request->email ;  
    $customer->save();

    // redirect
    $request->session()->flash('success', trans('customers.customer').' '.trans('crud.updated'));
    return redirect('admin/customers/' . $id . '/edit');
  }
  
  /**
   * Delete a customer
   *
   * @param string $id
   * 
   * @return Redirect
   */
  public function destroy( $id )
  {
    // delete
    $customer = User::find($id);      
    $customer->delete();

    // redirect
    $request->session()->flash('success',  trans('customers.customer').' '.trans('crud.deleted'));
    return redirect('admin/customers');
  }
}