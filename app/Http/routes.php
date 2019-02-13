<?php
use App\Cost;
use App\Month;
use App\Usage;
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
Route::get('admin/admin/delete/{id}','AdminController@destroy');
Route::get('admin/level','LevelController@index');
Route::get('admin/cost/delete/{id}','CostController@destroy');
Route::get('admin/customer/delete/{id}','CustomerController@destroy');
Route::get('admin/customer','CustomerController@customer');
Route::get('admin/cost','CostController@index');
Route::get('admin/usage','UsageController@index');
Route::get('admin/usage/add/{id}','UsageController@loadCreate');
Route::get('admin/usage/detail/{id}','UsageController@detail');
Route::get('admin/usage/delete/{id}','UsageController@destroy');
Route::get('admin/usage/bill/{id}','BillController@detail');
Route::get('admin/payment','PaymentController@index');
Route::get('admin/payment/accept/{id_payment}/{id_bill}','PaymentController@accept');
Route::get('admin/payment/reject/{id_payment}/{id_bill}','PaymentController@reject');
Route::get('admin/history','HistoryController@index');
Route::post('admin/usage/add/{id}','UsageController@create');
Route::post('admin/login','AuthController@adminLogin');
Route::post('admin/admin/add','AdminController@create');
Route::post('admin/admin/update','AdminController@update');
Route::post('admin/cost/add','CostController@create');
Route::post('admin/cost/update','CostController@update');
Route::post('admin/customer/add','CustomerController@create');
Route::post('admin/customer/update','CustomerController@update');

// Customer route
Route::get('/','CustomerController@index');
Route::get('login',function(){
  return view('customer.login');
});
Route::get('register',function(){
  $power = Cost::all();
  return view('customer.register', ['power' => $power]);
});
Route::get('/logout', function(){
  Session::flush();
  return redirect('login');
});
Route::get('bill','BillController@customer');
Route::post('login','AuthController@customerLogin');
Route::post('register','CustomerController@register');
Route::post('bill/confirm','BillController@confirm');

// Teller route
Route::get('teller','TellerController@index');
Route::get('admin/login',function(){
  return view('admin.login');
});
Route::get('teller/logout', function(){
  Session::flush();
  return redirect('admin/login');
});
Route::get('teller/history','HistoryController@index');
Route::post('teller/login','AuthController@adminLogin');
Route::post('/month/{id}/{year}', function($id,$year){
  $usage = Usage::where('year',$year)->where('id_customer',$id)->select('month')->get();
  $result = [];
  foreach($usage as $data){
    array_push($result,$data->month);
  }
  $data = Month::whereNotIn('id',$result)->get();  
  foreach($data as $datas){
    echo "<option value='$datas->id'>$datas->name</option>";
  }
});