<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::auth();

//Route::get('/', ['uses' => 'Basic\HomeController@index']);

// frontend routes
Route::group(['namespace' => 'Themes\\'.ucfirst(config('app.theme'))], function() {
  Route::get('/', ['uses' => 'HomeController@index']);
  
  // customer routes
  Route::group(['prefix' => 'account', 'middleware' => 'auth'], function() {
    Route::get('/', function(){
      echo 'account' ;
    });
  });
  
}); 
  
// admin routes
Route::get('admin','Admin\AdminController@login');
Route::get('admin/login','Admin\AdminController@login');
Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['auth','admin']], function() {

  // dashboard
  Route::get('/dashboard', ['as' => 'dashboard', 'uses' => 'DashboardController@show']);
  Route::post('remember', ['uses' => 'DashboardController@remember']);
  Route::get('remember', ['uses' => 'DashboardController@remember']);
  
  // settings
  Route::resource('settings', 'SettingsController');
  
  // shops
  Route::resource('shops', 'ShopsController');
  
  // users
  Route::resource('users', 'UsersController');
  
  // categories
  Route::post('categories/save-order', ['uses' => 'CategoriesController@saveOrder']);
  Route::resource('categories', 'CategoriesController');
  
  
  // products
  Route::resource('products', 'ProductsController');
  
  // customers
  Route::resource('customers', 'CustomersController');
  Route::resource('addresses', 'AddressesController');
  
  // orders
  Route::resource('orders', 'OrdersController');
  
  // pages
  Route::resource('pages', 'PagesController');
  
  // blog
  Route::resource('blog', 'BlogController');

});