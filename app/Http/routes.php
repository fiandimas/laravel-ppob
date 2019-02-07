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

// Admin Route


Route::get('admin','AdminController@index');
Route::get('admin/login', function(){
 if(Session::get('login')){
   return redirect('/admin');
 }else{
   return view('admin.login');
 }
});
Route::get('admin/logout', function(){
  Session::flush();
  return redirect('admin/login');
});

Route::get('admin/admin','AdminController@admin');
Route::get('admin/level/delete/{id}','LevelController@destroy');
Route::get('admin/level/show/{id}','LevelController@show');
Route::get('admin/level','LevelController@index');
Route::get('admin/admin/delete/{id}','AdminController@destroy');
Route::get('admin/cost/delete/{id}','CostController@destroy');
Route::get('admin/customer/delete/{id}','CustomerController@destroy');
Route::get('admin/customer','CustomerController@index');
Route::get('admin/cost','CostController@index');
Route::get('admin/usage','UsageController@index');
Route::post('admin/login','AuthController@adminLogin');
Route::post('admin/level/add','LevelController@create');
Route::post('admin/admin/add','AdminController@create');
Route::post('admin/cost/add','CostController@create');
Route::post('admin/customer/add','CustomerController@create');

// Customer route
Route::get('/','CustomerController@index');
Route::get('/login',function(){
  return view('customer.login');
});
Route::get('/logout', function(){
  Session::flush();
  return redirect('login');
});
Route::post('login','AuthController@customerLogin');