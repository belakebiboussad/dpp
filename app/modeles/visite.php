<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class visite extends Model
{
  //
	public $timestamps = false;
  //protected $fillable  = ['id_visite','date_visite','heure_visite','id_hosp','id_employe'];
  protected $fillable  = ['date','heure','id_hosp','id_employe'];
  public function hospitalisation()
  {
  	return $this->belongsTo('App\modeles\hospitalisation','id_hosp');
  }
  public function actes()
  {
  	return $this->hasMany('App\modeles\Acte','id_visite');
  }
}
