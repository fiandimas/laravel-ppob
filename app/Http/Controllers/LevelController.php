<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Hash;
use Session;
use Illuminate\Http\Request;
use App\Level;

class LevelController extends Controller {

  public function __construct(){
    $this->middleware('admin');
  }
  
	public function index(){
		$data = array(
      'no' => 1,
      'level' => Level::all(),
      'capt' => 'Level'
    );
    return view('admin.level',$data);
  }
}
