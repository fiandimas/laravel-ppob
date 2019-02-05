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
          'level' => Level::all()
        );
        return view('admin.level',$data);
      }else{
        return view('errors/403');
      }
    }
	}

}
