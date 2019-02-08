<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Session;
use DB;
use App\Bill;
use App\Usage;
use App\Payment;
use Illuminate\Http\Request;
use File;

class BillController extends Controller {

	public function index(){
    if(!Session::get('login')){
      return redirect('login')->with('fail','You must login first!');
    }else{
      if(Session::get('level') == 'customer'){
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
      'n' => 'Belum Lunas',
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
      'month' => $month,
      'capt' => 'Tagihan'
    );
    
    return view('admin.usage.bill', $data);
  }

  public function customer(){
    $bill =  DB::table('bill')
              ->where('usage.id_customer',Session::get('id'))
              ->join('usage','usage.id','=','bill.id_usage')
              ->join('customer','customer.id','=','usage.id_customer')
              ->join('cost','cost.id','=','customer.id_cost')
              ->leftJoin('payment','bill.id','=','payment.id_bill')
              ->select('bill.id','bill.month','bill.year','cost.cost','bill.total_meter','payment.status','payment.bukti')
              ->orderBy('bill.id','DESC')
              ->get();
    $status = array(
      '' => 'Belum Upload',
      'n' => 'Belum Bayar',
      'y' => 'Lunas',
      'p' => 'Pending',
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
      12 => 'Desember'
  );
    $data = array(
      'bill' => $bill,
      'status' => $status,
      'capt' => 'Tagihan',
      'month' => $month
    );
    return view('customer.bill', $data);
  }

  public function confirm(Request $req){
    // Validate photo
    $this->validate($req,[
      'photo' => 'required|image|mimes:jpeg,png,jpg'
    ]);
    // get photo and rename
    $photo = $req->file('photo');
    $photoName = time().'.'.$photo->getClientOriginalName();
    $path = public_path('/images/customer/bill');
    // FInd Bill with id and update status to pending
    $bill = Bill::find($req->id);
    $bill->status = 'p';
    

    // Find payment
    $payment = Payment::firstOrNew(['id_bill' => $req->id]);
    $payment->id_bill = $bill->id;
    $payment->date = Date('Y-m-d');
    $payment->id_month = $bill->month;
    $payment->year = $bill->year;
    $payment->admin_cost = 10000;
    $payment->total = $req->total;
    $payment->bukti = $photoName;
    $payment->status = 'p';
      // Save
    $payment->save();
    
    $bill->save();
    $save = $photo->move($path,$photoName);
    // Redirect
    return redirect()->back()->with('success','Success send confirm');
  }

}