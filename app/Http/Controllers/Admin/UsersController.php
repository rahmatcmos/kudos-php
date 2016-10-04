<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\User ;
use Validator ;
use Hash ;

class UsersController extends AdminController
{
  public function __construct()
  {
    parent::__construct() ;
    view()->share('shop_remove', true);
  }
  
  /**
   * List all users
   *
   * @return Response
   */
  public function index()
  {
    $users = User::all();
    return view('admin/users/index', ['users' => $users]);
  }
  
  /**
   * Create a user
   *
   * @return Response
   */
  public function create()
  {
    return view('admin/users/create');
  }
  
  /**
   * Save a user
   * 
   * @return Redirect
   */
  public function store(Request $request)
  {
    // validate
    $this->validate($request, [
      'first_name'       => 'required',
      'email'      => 'required|email|unique:users',
      'password'   => 'required'
    ]);

    // store
    $user = new user;
    $user->first_name = $request->first_name ;
    $user->last_name = $request->last_name ;
    $user->email = $request->email ;
    $user->admin = 1 ;
    $user->password = Hash::make($request->password) ;
    $user->save();

    // redirect
    $request->session()->flash('success',  trans('users.user').' '.trans('crud.created'));
    return redirect('admin/users/' . $user->id . '/edit');
  }
  
  /**
   * Edit a user
   *
   * @param string $id
   * 
   * @return Response
   */
  public function edit( $id )
  {
    $user = User::find($id) ;
    return view('admin/users/edit', ['user' => $user]);
  }
  
  /**
   * Update a user
   *
   * @param string $id
   * 
   * @return Redirect
   */
  public function update(Request $request, $id)
  {
    // validate
    $this->validate($request, [
      'first_name'       => 'required',
      'email'      => 'email|unique:users,email,'.$id
    ]);
    
    // store
    $user = User::find($id);
    $user->first_name = $request->first_name ;
    $user->last_name = $request->last_name ;
    $user->email = $request->email;
    $user->admin = 1 ;
    if($request->password)
      $user->password = Hash::make($request->password) ;
    $user->save();

    // redirect
    $request->session()->flash('success', trans('users.user').' '.trans('crud.updated'));
    return redirect('admin/users/' . $id . '/edit');
  }
  
  /**
   * Delete a user
   *
   * @param string $id
   * 
   * @return Redirect
   */
  public function destroy(Request $request, $id )
  {
    // delete
    $user = User::find($id);      
    $user->delete();

    // redirect
    $request->session()->flash('success',  trans('users.user').' '.trans('crud.deleted'));
    return redirect('admin/users');
  }

    
}