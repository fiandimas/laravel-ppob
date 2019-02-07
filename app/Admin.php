<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model {

  protected $table = 'admin';
  public $timestamps = false;
    
  public function level(){
    return $this->hasMany('App\Level','id','id_level');
  }

}
