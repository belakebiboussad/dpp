<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class employe_colloque extends Model
{
  //
  public $timestamps = false;
  protected $table="membres";
  protected $fillable  = ['id_colloque','id_employ'];
  public function Colloque()
  {
		return $this->hasOne('App\modeles\colloque','id_colloque');
  }
  public function Employe()
  {
  	return $this->hasOne('App\modeles\employ','id_employ');
  }

}
