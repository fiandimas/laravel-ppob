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
      'month' => $month,
      'capt' => 'Tagihan'
    );
    
    return view('admin.usage.bill', $data);
  }

  public function customer(){
    $bill =  DB::table('bill')
              ->where('id_customer',Session::get('id'))
              ->join('usage','usage.id','=','bill.id_usage')
              ->join('customer','customer.id','=','usage.id_customer')
              ->join('cost','cost.id','=','customer.id_cost')
              ->join('payment','bill.id','=','payment.id_bill')
              ->select('bill.id','bill.month','bill.year','cost.cost','bill.total_meter','bill.status','payment.bukti')
              ->get();
    $status = array(
      'n' => 'Belum Bayar',
      'y' => 'Lunas',
      'p' => 'Pending'
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
    $bill->save();

    // Find payment
    $payment = Payment::where('id_bill',$req->id)->first();
    // Delete previous confirm if exists
    if(File::exists(public_path('images/customer/bill/'.$payment->bukti))){
      File::delete(public_path('images/customer/bill/'.$payment->bukti));
    }
    // Save
    $payment->bukti = $photoName;
    $payment->save();
    $save = $photo->move($path,$photoName);
    // Redirect
    return redirect()->back()->with('success','Success send confirm');
  }

}