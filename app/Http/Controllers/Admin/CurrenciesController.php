<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Currency;

class CurrenciesController extends AdminController
{
  /**
   * Automatically get currency rates from fixer.io
   *
   * @return Redirect
   */
  public function auto(Request $request)
  {
    $url = 'http://api.fixer.io/latest?base='.env('APP_CURRENCY');
    $rates = json_decode(file_get_contents($url), true);
    if($rates){
      $currency = Currency::firstOrNew([ 
        'currency'  => env('APP_CURRENCY'),
        'rate'      => 1
      ]);
      $currency->save() ;
      foreach($rates['rates'] as $code => $rate){
        $currency = Currency::firstOrNew([ 
          'currency'  => $code
        ]);
        $currency->rate = $rate ;
        $currency->save() ;
      }
      $request->session()->flash('success',  trans('currencies.currency').' '.trans('crud.updated'));
      return redirect('admin/currencies');
    }
    $request->session()->flash('danger',  trans('currencies.currencies').' '.trans('crud.failed'));
    return redirect('admin/currencies');
  }
  
  /**
   * List all currencies
   *
   * @return Response
   */
  public function index()
  {
    $currencies = Currency::all() ;
    return view('admin/currencies/index', ['currencies' => $currencies]);
  }
  
  /**
   * Create a currency
   *
   * @return Response
   */
  public function create()
  {
    return view('admin/currencies/create');
  }
  
  /**
   * Save a currency
   * 
   * @return Redirect
   */
  public function store(Request $request)
  {
    // store
    $data = $request->except(['_token', '_method']) ;
    $currency = Currency::create($data);

    // redirect
    $request->session()->flash('success',  trans('currencies.currency').' '.trans('crud.created'));
    return redirect('admin/currencies/' . $currency->id . '/edit');
  }
  
  /**
   * Edit a currency
   *
   * @param string $id
   * 
   * @return Response
   */
  public function edit( $id )
  {
    $currency = Currency::find($id) ;
    return view('admin/currencies/edit', ['currency' => $currency]);
  }
  
  /**
   * Update a currency
   *
   * @param string $id
   * 
   * @return Redirect
   */
  public function update(Request $request, $id )
  {
    // store
    $currency = Currency::find($id);
    $data = $request->except(['_token', '_method']) ;
    $currency->fill($data) ;
    $currency->save();

    // redirect
    $request->session()->flash('success', trans('currencies.currency').' '.trans('crud.updated'));
    return redirect('admin/currencies/' . $id . '/edit');
  }
  
  /**
   * Delete a currency
   *
   * @param string $id
   * 
   * @return Redirect
   */
  public function destroy( $id )
  {
    // delete
    $currency = Currency::find($id);      
    $currency->delete();

    // redirect
    $request->session()->flash('success',  trans('currencies.currency').' '.trans('crud.deleted'));
    return redirect('admin/currencies');
  }
}