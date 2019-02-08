<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Customer;
use App\Cost;
use Session;
use Hash;
use DB;

class CustomerController extends Controller {

  public function __construct(){
    $this->middleware('admin', ['except' => 
      ['index']
    ]);
  }

	public function index(){
    return view('customer.dashboard',['capt' => 'Dashboard']);
  }
  
  public function customer(){
    $customer = DB::table('customer')
                    ->join('cost','cost.id','=','customer.id_cost')
                    ->select('customer.id','customer.name','customer.name','customer.username','customer.kwh_number','customer.address','cost.power')
                    ->get();
    $power = Cost::all();
    $data= array(
      'no' => 1,
      'customer' => $customer,
      'power' => $power,
      'capt' => 'Pelanggan'
    );

    return view('admin.customer', $data);
  }

  public function create(Request $req){
    $this->validate($req,[
      'name' => 'required|min:4',
      'username' => 'required|min:4|max:8|unique:customer,username',
      'password' => 'required|min:4|max:8',
      'address' => 'required',
      'kwh_number' => 'required'
    ]);

    $customer = new Customer();
    $customer->name = $req->name;
    $customer->username = $req->username;
    $customer->password = Hash::make($req->password);
    $customer->address = $req->address;
    $customer->kwh_number = $req->kwh_number;
    $customer->id_cost = $req->power;
    $customer->save();

    return redirect()->back()->with('success','Success add customer');
    
  }

  public function update(Request $req){
    $customer = Customer::find($req->id);
    $customer->name = $req->name;
    $customer->kwh_number = $req->kwh_number;
    $customer->address = $req->address;
    $customer->id_cost = $req->power;
    $customer->save();

    return redirect()->back()->with('success','Success update customer');
  }

  public function destroy($id){
    $customer = Customer::find($id);
    if($customer == null){
      return redirect('admin/customer');
    }else{
      $customer->delete();
      
      return redirect('admin/customer')->with('success','Success delete customer');
    }
  }

}
