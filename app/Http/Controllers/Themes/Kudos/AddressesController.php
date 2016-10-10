<?php
namespace App\Http\Controllers\Themes\Kudos;

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
    return view('themes/kudos/addresses/index', ['addresses' => $addresses]);
  }
  
  /**
   * add address
   *
   * @return Response
   */
  public function create()
  {
    return view('themes/kudos/addresses/create');
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
    return view('themes/kudos/addresses/edit', ['address' => $address]);
  }
   
  /**
   * Save an Address
   * 
   * @return Redirect
   */
  public function store(Request $request )
  {
    $data = $request->except('_token') ;
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
  public function destroy(Request $request, $id )
  {
    // delete
    $address = Address::find($id);    
    $address->delete();

    // redirect
    $request->session()->flash('success',  trans('address.address').' '.trans('crud.deleted'));
    return back() ;
  }
}