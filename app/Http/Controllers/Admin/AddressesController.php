<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Address;

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
  public function store(Request $request)
  {
    Address::create($request->all());
    return back();
  }
  
  /**
   * Update an Address
   *
   * @param string $id
   * 
   * @return Redirect
   */
  public function update(Request $request, $id )
  {
    // store
    $address = Address::find($id)->update($request->all());
    
    // redirect
    $request->session()->flash('success', trans('address.address').' '.trans('crud.updated'));
    return back();
  }
  
  /**
   * Delete an Address
   *
   * @param string $id
   * 
   * @return Redirect
   */
  public function destroy(Request $request, $id )
  {
    // delete
    $Address = Address::find($id);      
    $Address->delete();

    // redirect
    $request->session()->flash('success',  trans('address.address').' '.trans('crud.deleted'));
    return back();
  }
}