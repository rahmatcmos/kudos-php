<?php

namespace App\Http\Controllers\Admin;
use App\User;
use App\Models\Address;
use App\Models\Order;
use Validator ;
use Input ;
use Session ;
use Redirect ;
use App ;

class CustomersController extends AdminController
{
  /**
   * List all customers
   *
   * @return Response
   */
  public function index()
  {
    $customers = User::where('shop_id', '=', Session::get('shop'))->get() ;
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
  public function store( )
  {
    // validate
    $rules = [
      'first_name'      => 'required',
      'last_name'       => 'required',
      'email'           => 'required|email|unique:mongodb.customers',
    ];
    $validator = Validator::make(Input::all(), $rules);
    if ($validator->fails()) {
      return Redirect::to('admin/customers/create')
        ->withErrors($validator)
        ->withInput();
    } else {
      // store
      $customer = new User;
      $customer->shop_id = Input::get('shop_id');
      $customer->first_name = Input::get('first_name') ;    
      $customer->last_name = Input::get('last_name') ;
      $customer->telephone = Input::get('telephone') ;
      $customer->email = Input::get('email') ;
      $customer->save();

      // redirect
      Session::flash('success',  trans('customers.customer').' '.trans('crud.created'));
      return Redirect::to('admin/customers/' . $customer->id . '/edit');
    }
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
  public function update( $id )
  {
    // validate
    $rules = [
      'first_name'       => 'required',
      'last_name'       => 'required',
      'email'            => 'required|email|unique:mongodb.customers,email,'.$id.',_id',
    ];
    $validator = Validator::make(Input::all(), $rules);
    if ($validator->fails()) {
      return Redirect::to('admin/customers/' . $id . '/edit')
        ->withErrors($validator)
        ->withInput();
    } else {
      // store
      $customer = User::find($id);
      $customer->shop_id = Input::get('shop_id');
      $customer->first_name = Input::get('first_name') ;    
      $customer->last_name = Input::get('last_name') ;
      $customer->telephone = Input::get('telephone') ;
      $customer->email = Input::get('email') ;  
      $customer->save();

      // redirect
      Session::flash('success', trans('customers.customer').' '.trans('crud.updated'));
      return Redirect::to('admin/customers/' . $id . '/edit');
    }
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
    Session::flash('success',  trans('customers.customer').' '.trans('crud.deleted'));
    return Redirect::to('admin/customers');
  }
}