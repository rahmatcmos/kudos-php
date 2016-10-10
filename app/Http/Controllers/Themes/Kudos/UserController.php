<?php
namespace App\Http\Controllers\Themes\Kudos;

use Illuminate\Http\Request;
use App\User ;
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
    return view('themes/kudos/user/index', ['settings' => $settings]);
  }
  
  /**
   * Update settings
   * 
   * @return Redirect
   */
  public function store(Request $request)
  {
    // validate
    $this->validate($request, [
      'email' => 'email|unique:users,email,'.Auth::user()->id
    ]);
      
    // store
    $user = User::find(Auth::user()->id);
    $user->email = $request->email;
    $user->telephone = $request->telephone;
    if($request->get('password'))
      $user->password = Hash::make($request->password) ;
    $user->save();

    // redirect
    $request->session()->flash('success', trans('settings.settings').' '.trans('crud.updated'));
    return redirect('/account/settings');
  }

}