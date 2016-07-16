<?php

namespace App\Http\Controllers\Admin;
use App\Models\Address;
use Input ;
use Redirect ;
use Session ;

class AddressesController extends AdminController
{
 
 
  /**
   * Edit an address
   *
   * @param string $id
   * 
   * @return Response
   */
  public function edit( $id )
  {
    $address = Address::find($id) ;
    return view('admin/addresses/edit', ['address' => $address]);
  }
   
  /**
   * Save an Address
   * 
   * @return Redirect
   */
  public function store( )
  {
    Address::create(Input::all());
    return Redirect::back();
  }
  
  /**
   * Update an Address
   *
   * @param string $id
   * 
   * @return Redirect
   */
  public function update( $id )
  {
    // store
    $address = Address::find($id)->update(Input::all());
    
    // redirect
    Session::flash('success', trans('address.address').' '.trans('crud.updated'));
    return Redirect::back();
  }
  
  /**
   * Delete an Address
   *
   * @param string $id
   * 
   * @return Redirect
   */
  public function destroy( $id )
  {
    // delete
    $Address = Address::find($id);      
    $Address->delete();

    // redirect
    Session::flash('success',  trans('Addresss.Address').' '.trans('crud.deleted'));
    return Redirect::back();
  }
}