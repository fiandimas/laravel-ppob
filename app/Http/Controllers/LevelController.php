<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Hash;
use Session;
use Illuminate\Http\Request;
use App\Level;

class LevelController extends Controller {

	public function index()
	{
		if(!Session::get('login')){
      return redirect('admin/login')->with('fail','You must login first!');
    }else{
      if(Session::get('level') == 1){
        $data = array(
          'no' => 1,
          'level' => Level::all(),
          'capt' => 'Level'
        );
        return view('admin.level',$data);
      }else{
        return view('errors/403');
      }
    }
  }
  
  public function destroy($id){
    $level = Level::find($id);
    if($level == null){
      return redirect('admin/level');
    }else{
      $level->delete();
      return redirect('admin/level')->with('success','Succss delete level');
    }    
  }

  public function show($id){
    return Level::find($id);
  }

}
