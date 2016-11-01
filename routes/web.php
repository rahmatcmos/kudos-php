<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Auth::routes();

Route::get('/account','OrdersController@index');

// frontend routes
Route::group(['namespace' => 'Themes\\'.ucfirst(config('app.theme'))], function() {
  Route::get('/', 'ProductsController@index');
  
  // categories
  Route::resource('categories', 'CategoriesController');
  
  // products
  Route::get('products/search/{category?}', 'ProductsController@search');
  Route::get('products/scroll', 'ProductsController@scroll');
  Route::post('products/filter', 'ProductsController@filter');
  Route::post('products/{id}/optionize', 'ProductsController@optionize');
  Route::resource('products', 'ProductsController');
  
  // basket
  Route::resource('basket', 'BasketController');
  
  // account
  Route::group(['prefix' => 'account', 'middleware' => 'auth'], function() {
    
    // order
    Route::get('/','OrdersController@index');
    Route::resource('orders', 'OrdersController');
    
    // settings
    Route::resource('settings', 'UserController');
    
    //addresses
    Route::resource('addresses', 'AddressesController');
    
  });
  
  // checkout
  Route::group(['middleware' => 'auth'], function() {
    Route::resource('checkout', 'CheckoutController');
  });
  
  // pages
  Route::resource('pages', 'PagesController');
  
  // blog
  Route::resource('blog', 'BlogController');
  
  // languages
  Route::resource('languages', 'LanguagesController');
  
  // currencies
  Route::resource('currencies', 'CurrenciesController');

}); 
  
// auto update currencies - should be secured in some way if you are using your own (manual) currency rates
Route::get('admin/currencies/auto', 'Admin\CurrenciesController@auto');

// admin routes
Route::get('admin','Admin\AdminController@login');
Route::get('admin/login','Admin\AdminController@login');
Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['auth','admin']], function() {

  // dashboard
  Route::get('/dashboard', 'DashboardController@show');
  Route::post('remember', 'DashboardController@remember');
  Route::get('remember', 'DashboardController@remember');
  
  // settings
  Route::post('settings/theme-install', 'SettingsController@themeInstall');
  Route::post('settings/theme-uninstall', 'SettingsController@themeUninstall');
  Route::resource('settings', 'SettingsController');
  
  // currencies
  Route::resource('currencies', 'CurrenciesController');
  
  // media
  Route::post('media/delete', 'MediaController@delete')->name('delete');
  Route::post('media/default/{id}/{type}', 'MediaController@default')->name('default');
  Route::post('media/upload/images/{dir}/{id}', 'MediaController@uploadImages')->name('upload');
  Route::get('media/generate/images/{dir}/{id}/{file}', 'MediaController@generateImages')->name('generate');
  Route::get('media/thumbnails/{id}/{model?}/{type?}', 'MediaController@getThumbnails')->name('thumbnails');
  
  // shops
  Route::resource('shops', 'ShopsController');
  
  // users
  Route::resource('users', 'UsersController');
  
  // categories
  Route::post('categories/save-order', 'CategoriesController@saveOrder');
  Route::resource('categories', 'CategoriesController');
  
  
  // products
  Route::get('products/{id}/options', 'ProductsController@options');
  Route::post('products/{id}/store-option', 'ProductsController@storeOption');
  Route::delete('products/{id}/delete-option', 'ProductsController@deleteOption');
  Route::post('products/{id}/add-existing-option', 'ProductsController@addExistingOption');
  Route::post('products/{id}/add-options', 'ProductsController@addOptions');
  Route::post('products/{id}/update-option-name', 'ProductsController@updateOptionName');
  Route::post('products/{id}/update-option-value', 'ProductsController@updateOptionValue');
  Route::post('products/{id}/add-product-option', 'ProductsController@addProductOption');
  Route::get('products/{id}/delete-product-option/{povId}', 'ProductsController@deleteProductOption');
  Route::resource('products', 'ProductsController');
  
  // options
  Route::resource('options', 'OptionsController');
  
  // customers
  Route::resource('customers', 'CustomersController');
  Route::resource('addresses', 'AddressesController');
  
  // orders
  Route::resource('orders', 'OrdersController');
  
  // pages
  Route::resource('pages', 'PagesController');
  
  // blog
  Route::resource('blog', 'BlogController');
  
  // slugify
  Route::post('slugify', 'SlugController@slugify');
  Route::get('slugify', 'SlugController@slugify');

});