<?php namespace App\Http\Middleware;

use Closure;
use Session;

class Admin {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		if(!Session::get('login')){
      return redirect('admin/login')->with('fail','You must login first');
    }else{
      if(Session::get('level') == 1){
        return $next($request);
      }else{
        return view('errors.403');
      }
    }
	}

}
