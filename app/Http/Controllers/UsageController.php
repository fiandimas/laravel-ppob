<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Customer;
use App\Usage;
use App\Month;
use App\Bill;
use Session;
use DB;

class UsageController extends Controller {

  public function __construct(){
    $this->middleware('admin');
  }

	public function index(){
		if(Session::get('level') == 1){
      $customer = DB::table('customer')
                      ->join('cost','cost.id','=','customer.id_cost')
                      ->select('customer.id','customer.name','customer.kwh_number','cost.power')
                      ->get();
      $data = array(
        'no' => 1,
        'customer' => $customer,
        'capt' => 'Daftar Penggunaan'
      );

      return view('admin.usage', $data);
    }
  }

  public function create(Request $req,$id){
    $this->validate($req,[
      'start_meter' => 'required|numeric',
      'finish_meter' => 'required|numeric'
    ]);
    $usage = Usage::firstOrNew(['month' => $req->month, 'year' => $req->year, 'id_customer' => $id]);
    if($usage->id == null){
      $usage->id_customer = $id;
      $usage->month = $req->month;
      $usage->year = $req->year;
      $usage->start_meter = $req->start_meter;
      $usage->finish_meter = $req->finish_meter;
      $usage->save();
      
      $bill = new Bill();
      $bill->id_usage = $usage->id;
      $bill->month = $usage->month;
      $bill->year = $usage->year;
      $bill->total_meter = $usage->start_meter + $usage->finish_meter;
      $bill->save();

      return redirect('admin/usage')->with('success','Success add usage');
    }else{
      return redirect('admin/usage/add/'.$id)->with('fail','Penggunaan bulan ini sudah ada');
    }
  }

  public function loadCreate($id){
    $customer = Customer::find($id);
    $data = array(
      'customer' => $customer,
      'month' => Month::all(),
      'capt' => 'Penggunaan'
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
      'month' => $month,
      'capt' => 'Penggunaan'
    );
      
    return view('admin.usage.detail', $data);
  }

  public function destroy($id){
    $payment =  DB::table('usage')
                ->where('usage.id',$id)
                ->join('bill','bill.id_usage','=','usage.id')
                ->leftJoin('payment','payment.id_bill','=','bill.id');
    
    if($payment->select('payment.id')->first()->id == null){
      $delete =  $payment->select('usage.id as uid','bill.id as bid','usage.id_customer')->first();      
      $bill = Bill::find($delete->bid);
      $bill->delete();

      $usage = Usage::find($delete->uid);
      $usage->delete();

      return redirect('admin/usage/detail/'.$delete->id_customer)->with('success','Success delete usage');
    }else{
      $delete =  $payment->select('usage.id_customer')->first();      
      return redirect('admin/usage/detail/'.$delete->id_customer)->with('fail','Cant delete usage');
    }
  }
}
