<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Session;
use DB;
use App\Bill;
use Illuminate\Http\Request;

class BillController extends Controller {

	public function index(){
    if(!Session::put('login')){
      return redirect('login')->with('fail','You must login first!');
    }else{
      if(Session::put('level') == 'customer'){
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
        $bill = DB::table('bill')
                      ->join('usage','usage.id','=','bill.id_usage')
                      ->join('customer','customer.id','=','usage.id_customer')
                      ->select('bill.id','bill.date','')
                      ->get();
      }else{
        return view('errors.403');
      }
    }
  }

  public function detail($id){
    $bill = DB::table('bill')
                  ->join('usage','usage.id','=','bill.id_usage')
                  ->where('id_customer',$id)
                  ->select('bill.month','bill.year','bill.total_meter','bill.status')
                  ->get();
    $status = array(
      'y' => 'Lunas',
      'n' => 'Belum Lunas'
    );
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
      'bill' => $bill,
      'status' => $status,
      'month' => $month
    );
    
    return view('admin.usage.bill', $data);
  }

}
