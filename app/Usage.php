<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Usage extends Model {

	protected $table = 'usage';
  public $timestamps = false;

  protected $fillable = ['month','year','id_customer'];
}
