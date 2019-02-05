<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Hash;
use Session;
use Illuminate\Http\Request;

class AdminController extends Controller {

	public function index()
	{
		if(!Session::get('login')){
      return redirect('admin/login')->with('fail','You must login first!');
    }else{
      if(Session::get('level') == 1){
        return view('admin.dashboard');
      }else{
        return view('errors/403');
      }
    }
	}

}
