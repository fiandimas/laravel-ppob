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
Route::get('/admin','AdminController@index');
Route::get('/admin/login', function(){
 if(Session::get('login')){
   return redirect('/admin');
 }else{
   return view('admin.login');
 }
});
Route::get('/admin/logout', function(){
  Session::flush();
  return redirect('/admin/login');
});
Route::get('/admin/level','LevelController@index');
Route::post('/admin/login','AuthController@adminLogin');
