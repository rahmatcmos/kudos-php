<?php
namespace App\Http\Controllers\Themes\Basic;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Address;

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
  public function store(Request $request )
  {
    $data = $request->all() ;
    $data['customer_id'] = Auth::user()->id ;
    Address::create($data);
    return redirect('/account/addresses');
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
  public function destroy( $id )
  {
    // delete
    $Address = Address::find($id);      
    $Address->delete();

    // redirect
    $request->session()->flash('success',  trans('address.address').' '.trans('crud.deleted'));
    return back() ;
  }
}