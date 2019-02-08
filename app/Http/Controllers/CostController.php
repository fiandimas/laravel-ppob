<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Cost;
use DB;

class CostController extends Controller {

  public function __construct(){
    $this->middleware('admin');
  }

	public function index(){
    $data = array(
      'no' => 1,
      'cost' => Cost::all(),
      'capt' => 'Tarif'
    );

    return view('admin.cost',$data);
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

  public function update(Request $req){
    $cost = Cost::find($req->id);
    $cost->power = $req->power;
    $cost->cost = $req->cost;
    $cost->save();

    return redirect()->back()->with('success','Success update cost');
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
