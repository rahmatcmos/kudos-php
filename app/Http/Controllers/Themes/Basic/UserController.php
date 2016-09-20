<?php

namespace App\Http\Controllers\Themes\Basic;
use App\User ;
use Validator ;
use Input ;
use Session ;
use Redirect ;
use Hash ;
use Illuminate\Support\Facades\Auth;

class UserController extends ThemeController
{
  
  /**
   * Edit settings
   *
   * @param string $id
   * 
   * @return Response
   */
  public function index()
  {
    $settings = User::find(Auth::user()->id) ;
    return view('themes/basic/user/index', ['settings' => $settings]);
  }
  
  /**
   * Update settings
   * 
   * @return Redirect
   */
  public function store( )
  {
    // validate
    $rules = [
      'email'      => 'email|unique:users,email,'.Auth::user()->id
    ];
    $validator = Validator::make(Input::all(), $rules);
    if ($validator->fails()) {
      return Redirect::to('account/settings')
        ->withErrors($validator)
        ->withInput();
    } else {
      // store
      $user = User::find(Auth::user()->id);
      $user->email = Input::get('email');
      $user->telephone = Input::get('telephone');
      if(Input::get('password'))
        $user->password = Hash::make(Input::get('password')) ;
      $user->save();

      // redirect
      Session::flash('success', trans('settings.settings').' '.trans('crud.updated'));
      return Redirect::to('/account/settings');
    }
  }

}