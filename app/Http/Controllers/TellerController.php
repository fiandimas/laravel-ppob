<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;

class TellerController extends Controller {

  public function __construct(){
    $this->middleware('teller');
  }

	public function index(){
		return view('teller.dashboard', ['capt' => 'Dashboard']);
  }

}
