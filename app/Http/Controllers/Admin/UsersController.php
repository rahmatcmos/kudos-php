<?php

namespace App\Http\Controllers\Admin;
use App\User ;
use Validator ;
use Input ;
use Session ;
use Redirect ;
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
  public function store(  )
  {
    // validate
    $rules = [
      'name'       => 'required',
      'email'      => 'required|email|unique:users',
      'password'   => 'required'
    ];
    $validator = Validator::make(Input::all(), $rules);
    if ($validator->fails()) {
      return Redirect::to('admin/users/create')
        ->withErrors($validator)
        ->withInput();
    } else {
      // store
      $user = new user;
      $user->name = Input::get('name') ;
      $user->email = Input::get('email') ;
      $user->password = Hash::make(Input::get('password')) ;
      $user->save();

      // redirect
      Session::flash('success',  trans('users.user').' '.trans('crud.created'));
      return Redirect::to('admin/users/' . $user->id . '/edit');
    }
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
  public function update( $id )
  {
    // validate
    $rules = [
      'name'       => 'required',
      'email'      => 'email|unique:users,email,'.$id
    ];
    $validator = Validator::make(Input::all(), $rules);
    if ($validator->fails()) {
      return Redirect::to('admin/users/' . $id . '/edit')
        ->withErrors($validator)
        ->withInput();
    } else {
      // store
      $user = User::find($id);
      $user->name = Input::get('name');
      $user->email = Input::get('email');
      if(Input::get('password'))
        $user->password = Hash::make(Input::get('password')) ;
      $user->save();

      // redirect
      Session::flash('success', trans('users.user').' '.trans('crud.updated'));
      return Redirect::to('admin/users/' . $id . '/edit');
    }
  }
  
  /**
   * Delete a user
   *
   * @param string $id
   * 
   * @return Redirect
   */
  public function destroy( $id )
  {
    // delete
    $user = User::find($id);      
    $user->delete();

    // redirect
    Session::flash('success',  trans('users.user').' '.trans('crud.deleted'));
    return Redirect::to('admin/users');
  }

    
}