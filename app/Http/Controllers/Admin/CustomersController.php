<?php

namespace App\Http\Controllers\Admin;
use App\Models\Customer;
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
    $customers = Customer::where('shop_id', '=', Session::get('shop'))->get() ;
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
   
    $verifier = App::make('validation.presence');
    $verifier->setConnection('mongodb'); 
    // validate
    $rules = [
      'first_name'      => 'required',
      'last_name'       => 'required',
      'email'           => 'required|email|unique:mongodb.customers',
    ];
    $validator = Validator::make(Input::all(), $rules);
    $validator->setPresenceVerifier($verifier);
    if ($validator->fails()) {
      return Redirect::to('admin/customers/create')
        ->withErrors($validator)
        ->withInput();
    } else {
      // store
      $customer = new customer;
      $customer->shop_id = Input::get('shop_id');
      $customer->first_name = Input::get('first_name') ;    
      $customer->last_name = Input::get('last_name') ;
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
    $customer = Customer::find($id) ;
    return view('admin/customers/edit', ['customer' => $customer]);
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
      $customer = Customer::find($id);
      $customer->shop_id = Input::get('shop_id');
      $customer->first_name = Input::get('first_name') ;    
      $customer->last_name = Input::get('last_name') ;
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
    $customer = Customer::find($id);      
    $customer->delete();

    // redirect
    Session::flash('success',  trans('customers.customer').' '.trans('crud.deleted'));
    return Redirect::to('admin/customers');
  }
}