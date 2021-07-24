<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class visite extends Model
{
  public $timestamps = false;
  protected $fillable  = ['date','heure','id_hosp','id_employe'];
  public function hospitalisation()
  {
  	return $this->belongsTo('App\modeles\hospitalisation','id_hosp');
  }
  public function actes()
  {
  	return $this->hasMany('App\modeles\Acte','id_visite')->where('retire','=', 0);
  }
  public function traitements()
  {
    return $this->hasMany('App\modeles\Traitement','visite_id');
  }
  public function demandeexmbio()
  {
    return $this->hasOne('App\modeles\demandeexb','visite_id');
  }
  public function demandExmImg()//examensradiologiques
  {
      return $this->hasOne('App\modeles\demandeexr','visite_id');
  }
  public function medecin(){
    return $this->belongsTo('App\modeles\employ','id_employe');

  }
}
