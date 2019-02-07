<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Session;
use DB;
use App\Usage;
use Illuminate\Http\Request;

class UsageController extends Controller {

	public function index(){
		if(!Session::get('login')){
      return redirect('admin/login')->with('fail','You must login first!');
    }else{
      if(Session::get('level') == 1){
        $customer = DB::table('customer')
                        ->join('cost','cost.id','=','customer.id_cost')
                        ->select('customer.id','customer.name','customer.kwh_number','cost.power')
                        ->get();
        $data = array(
          'no' => 1,
          'customer' => $customer
        );
        return view('admin.usage', $data);
      }else{
        return view('errors/403');
      }
    }
  }
}
