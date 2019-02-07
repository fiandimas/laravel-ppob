<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Cost;
use DB;
use Session;
use Illuminate\Http\Request;

class CostController extends Controller {

	public function index(){
    if(!Session::get('login')){
      return redirect('admin/login')->with('fail','You must login first!');
    }else{
      if(Session::get('level') == 1){
        $data = array(
          'no' => 1,
          'cost' => Cost::all()
        );
        return view('admin.cost',$data);
      }else{
        return view('errors/403');
      }
    }
  }

  public function create(Request $req){
    $this->validate($req,[
      'power' => 'required|numeric',
      'cost' => 'required|numeric'
    ]);

    $cost = new Cost();
    $cost->power = $req->power;
    $cost->cost = $req->cost;

    $cost->save();

    return redirect()->back()->with('success','Success add cost');
  }

  public function destroy($id){
    $cost = Cost::find($id);
    if($cost == null){
      return redirect('admin/cost');
    }else{
      $cost->delete();
      return redirect('admin/cost')->with('success','Success delete cost');
    }
  }

}
