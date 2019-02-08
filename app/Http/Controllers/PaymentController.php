<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Payment;
use App\Bill;
use Session;
use DB;

class PaymentController extends Controller {

  public function __construct(){
    $this->middleware('admin');
  }

	public function index(){
    $payment = DB::table('payment')
                  ->whereIn('payment.status',['p','n'])
                  ->join('bill','bill.id','=','payment.id_bill')
                  ->join('usage','usage.id','=','bill.id_usage')
                  ->join('customer','customer.id','=','usage.id_customer')
                  ->select('payment.id','customer.name','customer.kwh_number','payment.date','payment.id_month','payment.year','payment.admin_cost','payment.total','payment.status','payment.bukti','payment.id_bill')
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
      'p' => 'Pending',
      'n' => 'Belum Bayar'
    );               
    $data = array(
      'capt' => 'Pembayaran',
      'payment'=> $payment,
      'month' => $month,
      'status' => $status
    );
    
    return view('admin.payment', $data);
  }

  public function accept($id_payment,$id_bill){
    $payment = Payment::find($id_payment);
    $payment->status = 'y';
    $payment->id_admin = Session::get('id');
    $payment->save();

    $bill = Bill::find($id_bill);
    $bill->status = 'y';
    $bill->save();

    return redirect('admin/payment')->with('success','Success accept confirmation');
  }

  public function reject($id_payment,$id_bill){
    $payment = Payment::find($id_payment);
    $payment->status = 'r';
    $payment->id_admin = Session::get('id');
    $payment->save();

    $bill = Bill::find($id_bill);
    $bill->status = 'r';
    $bill->save();

    return redirect('admin/payment')->with('success','Success reject confirmation');
  }

}
