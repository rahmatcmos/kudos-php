<?php

namespace App\Http\Controllers\Themes\Basic;
use App\Models\Address;
use Illuminate\Support\Facades\Auth;
use Input ;
use Redirect ;
use Session ;

class AddressesController extends ThemeController
{
  
  /**
   * List addresses
   * 
   * @return Response
   */
  public function index( )
  {
    $addresses = Address::where('customer_id', Auth::user()->id)->get() ;
    return view('themes/basic/addresses/index', ['addresses' => $addresses]);
  }
  
  /**
   * add address
   *
   * @return Response
   */
  public function create()
  {
    return view('themes/basic/addresses/create');
  }
 
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
    return view('themes/basic/addresses/edit', ['address' => $address]);
  }
   
  /**
   * Save an Address
   * 
   * @return Redirect
   */
  public function store( )
  {
    $data = Input::all() ;
    $data['customer_id'] = Auth::user()->id ;
    Address::create($data);
    return Redirect::to('/account/addresses');
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
    Session::flash('success',  trans('address.address').' '.trans('crud.deleted'));
    return Redirect::back();
  }
}