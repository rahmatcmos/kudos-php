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

// frontend routes
Route::group(['namespace' => 'Themes\\'.ucfirst(config('app.theme'))], function() {
  Route::get('/', ['uses' => 'HomeController@index']);
  
  // categories
  Route::resource('categories', 'CategoriesController');
  
  // products
  Route::resource('products', 'ProductsController');
  
  // basket
  
  // checkout
  
  // account
  Route::group(['prefix' => 'account', 'middleware' => 'auth'], function() {
    Route::get('/', function(){
      echo 'account' ;
    });
  });
  
  // pages
  Route::resource('pages', 'PagesController');
  
  // blog
  Route::resource('blog', 'BlogController');
  
}); 
  
// auto update currencies - should be secured in some way if you are using your own (manual) currency rates
Route::get('admin/currencies/auto', 'Admin\CurrenciesController@auto');

// admin routes
Route::get('admin','Admin\AdminController@login');
Route::get('admin/login','Admin\AdminController@login');
Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['auth','admin']], function() {

  // dashboard
  Route::get('/dashboard', ['as' => 'dashboard', 'uses' => 'DashboardController@show']);
  Route::post('remember', ['uses' => 'DashboardController@remember']);
  Route::get('remember', ['uses' => 'DashboardController@remember']);
  
  // settings
  Route::post('settings/theme-install', ['uses' => 'SettingsController@themeInstall']);
  Route::post('settings/theme-uninstall', ['uses' => 'SettingsController@themeUninstall']);
  Route::resource('settings', 'SettingsController');
  
  // currencies
  Route::resource('currencies', 'CurrenciesController');
  
  // media
  Route::post('media/delete', 'MediaController@delete')->name('delete');
  Route::post('media/default/{id}/{type}', 'MediaController@default')->name('default');
  Route::post('media/upload/images/{dir}/{id}', 'MediaController@uploadImages')->name('upload');
  Route::get('media/thumbnails/{id}/{model?}/{type?}', 'MediaController@getThumbnails')->name('thumbnails');
  
  // shops
  Route::resource('shops', 'ShopsController');
  
  // users
  Route::resource('users', 'UsersController');
  
  // categories
  Route::post('categories/save-order', ['uses' => 'CategoriesController@saveOrder']);
  Route::resource('categories', 'CategoriesController');
  
  
  // products
  Route::get('products/{page?}/{orderBy?}/{orderDir?}', 'ProductsController@index');
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