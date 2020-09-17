<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class employe_colloque extends Model
{
  //
  public $timestamps = false;
  protected $table="membres";
  protected $fillable  = ['id_colloque','id_employ'];
  public function Colloques()
  {
		return $this->belongsToMany('App\modeles\colloque','id_colloque');
  }
  public function Employes()
  {
  	return $this->belongsToMany('App\modeles\employ','id_employ');
  }

}
