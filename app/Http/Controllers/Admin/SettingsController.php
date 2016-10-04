<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Setting;

class SettingsController extends AdminController
{
  
  public function __construct()
  {
    parent::__construct() ;
    view()->share('body_class', 'settings');
  }
  
  /**
   * Edit settings
   *
   * @param string $id
   * 
   * @return Response
   */
  public function index(Request $request)
  {
    $settings = Setting::where('shop_id', $request->session()->get('shop'))->first() ;
    return view('admin/settings/edit', ['settings' => $settings]);
  }
  
  /**
   * Update settings
   *
   * @param string $shop_id
   * 
   * @return Redirect
   */
  public function update(Request $request, $shop_id)
  {
    $data = $request->except(['_token', '_method']) ;
    $data['shop_id'] = $shop_id ;
    $settings = Setting::where('shop_id', $shop_id)->first();
    if ($settings) { 
      $settings->update($data);
    } else {
      $settings = new Setting($data);
      $settings->save(); 
    }

    // redirect
    $request->session()->flash('success', trans('settings.settings').' '.trans('crud.updated'));
    return redirect('admin/settings');
  }

}