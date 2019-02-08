<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Session;
use Illuminate\Http\Request;

class PaymentController extends Controller {

	public function index(){
    if(!Session::get('login')){
      return redirect('admin/login')->with('fail','You must login first!');
    }else{
      if(Session::get('level') == 1){
        $payment = DB::table('payment')
                        ->where('payment.status','p')
                        ->join('bill','bill.id','=','payment.id_bill')
                        ->join('usage','usage.id','=','bill.id_usage')
                        ->join('customer','customer.id','=','usage.id_customer')
                        ->select('customer.name','customer.kwh_number','payment.date','payment.id_month','payment.year','payment.admin_cost','payment.total','payment.status','payment.bukti')
                        ->get();
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
        $status = array(
          'p' => 'Pending'
        );               
        $data = array(
          'capt' => 'Pembayaran',
          'payment'=> $payment,
          'month' => $month,
          'status' => $status
        );
        return view('admin.payment', $data);
      }else{
        return view('errors/403');
      }
    }
  }

}
