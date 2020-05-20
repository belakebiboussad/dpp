<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class visite extends Model
{
  //
	public $timestamps = false;
  protected $fillable  = ['date','heure','id_hosp','id_employe'];
  public function hospitalisation()
  {
  	return $this->belongsTo('App\modeles\hospitalisation','id_hosp');
  }
  public function actes()
  {
  	return $this->hasMany('App\modeles\Acte','id_visite')->where('retire','=', 0);;
  }
  public function medecin(){
    return $this->belongsTo('App\modeles\employ','id_employe');

  }
}
