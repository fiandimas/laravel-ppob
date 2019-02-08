<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Usae;
use DB;
use Session;
use Illuminate\Http\Request;

class HistoryController extends Controller {

  public function index(){
    $history = DB::table('payment')
                    ->join('bill','bill.id','=','payment.id_bill')
                    ->join('usage','usage.id','=','bill.id_usage')
                    ->join('customer','customer.id','=','usage.id_customer')
                    ->join('admin','admin.id','=','payment.id_admin')
                    ->select('customer.kwh_number','customer.name','payment.date','payment.id_month','payment.year','payment.admin_cost','payment.total','payment.status','payment.bukti','admin.name as aname')
                    ->orderBy('payment.id','DESC')
                    ->get();
    $status = array(
      'y' => 'Lunas',
      'r' => 'Ditolak'
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
      12 => 'D'
    );
    
    $data = array(
      'history' => $history,
      'status' => $status,
      'month' => $month,
      'capt' => 'Histori'
    );
    return view('admin.history', $data);
  }
}
