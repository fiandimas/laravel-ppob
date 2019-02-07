<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Session;
use DB;
use App\Usage;
use App\Customer;
use App\Month;
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

  public function create(Request $req,$id){
    $this->validate($req,[
      'start_meter' => 'required|numeric',
      'finish_meter' => 'required|numeric'
    ]);
    
    $usage = new Usage();
    $usage->id_customer = $id;
    $usage->month = $req->month;
    $usage->year = $req->year;
    $usage->start_meter = $req->start_meter;
    $usage->finish_meter = $req->finish_meter;

    $usage->save();

    return redirect('admin/usage')->with('success','Success add usage');
  }

  public function loadCreate($id){
    $customer = Customer::find($id);
    $data = array(
      'customer' => $customer,
      'month' => Month::all()
    );

    if($customer == null){
      return redirect('admin/usage');
    }else{
      return view('admin.usage.add', $data);
    }
  }

  public function detail($id){
    $usage = Usage::where('id_customer',$id)->get();
    $month = array(
      1 => 'Januari',
      2 => 'Februari',
      3 => 'Maret',
      4 => 'April',
      5 => 'Mei',
      6 => 'Juni',
      7 => 'Juli',
      8 => 'Agustus',
      9 => 'September',
      10 => 'Oktober',
      11 => 'November',
      12 => 'Desember'
    );
    $data = array(
      'no' => 1,
      'usage' => $usage,
      'month' => $month
    );

    if($usage->all() == null){
      return redirect('admin/usage');
    }else{
      return view('admin.usage.detail', $data);
    }
  }
}
