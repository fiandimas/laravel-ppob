<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Admin;
use App\Level;
use Session;
use Hash;
use DB;

class AdminController extends Controller {

  public function __construct(){
    $this->middleware('admin');
  }

	public function index(){
		return view('admin.dashboard', ['capt' => 'Dashboard']);
  }
  
  public function admin(){
    $admin = DB::table('admin')
                  ->join('level','level.id','=','admin.id_level')
                  ->select('admin.id','admin.name','admin.username','level.name as lname')
                  ->get();
    $data = array(
      'no' => 1,
      'admin' => $admin,
      'level' => Level::all(),
      'capt' => 'Admin'
    );
    return view('admin.admin',$data);
  }

  public function create(Request $req){
    $this->validate($req,[
      'name' => 'required|min:4',
      'username' => 'required|min:4|max:8|unique:admin,username',
      'password' => 'required|min:4|max:8'
    ]);

    $admin = new Admin();
    $admin->name = $req->name;
    $admin->username = $req->username;
    $admin->password = Hash::make($req->password);
    $admin->id_level = $req->level;
    $admin->save();
    
    return redirect()->back()->with('success','Success add admin');
  }

  public function destroy($id){
    $admin = Admin::find($id);
    if($admin == null){
      return redirect('admin/admin');
    }else{
      $admin->delete();
      return redirect('admin/admin')->with('success','Succss delete level');
    }    
  }

  public function update(Request $req){
    $admin = Admin::find($req->id);
    $admin->name = $req->name;
    $admin->id_level = $req->level;
    $admin->save();

    return redirect()->back()->with('success','Success update admin');
  }

}
