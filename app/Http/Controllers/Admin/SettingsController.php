<?php

namespace App\Http\Controllers\Admin;
use App\Models\Setting;
use Validator ;
use Input ;
use Session ;
use Redirect ;
use File ;

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
  public function index()
  {
    $settings = Setting::where('shop_id', Session::get('shop'))->first() ;
    $path = base_path().'/themes' ;
    $themes = File::directories($path);
    return view('admin/settings/edit', ['settings' => $settings, 'themes' => $themes]);
  }
  
  /**
   * Update settings
   *
   * @param string $shop_id
   * 
   * @return Redirect
   */
  public function update( $shop_id )
  {
    $data = Input::except(['_token', '_method']) ;
    $data['shop_id'] = $shop_id ;
    $settings = Setting::where('shop_id', $shop_id)->first();
    if ($settings) { 
      $settings->update($data);
    } else {
      $settings = new Setting($data);
      $settings->save(); 
    }

    // redirect
    Session::flash('success', trans('settings.settings').' '.trans('crud.updated'));
    return Redirect::to('admin/settings');
  }

}