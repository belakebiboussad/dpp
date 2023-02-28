<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;
class visite extends Model
{
    public $timestamps = true;
    protected $fillable  = ['date','heure','id_hosp','pid','id_employe'];
    protected $dates = ['date'];
    public function getDateFormatedAttribute()
    {
      return $this->date->format('Y-m-d');
    }
    public function hospitalisation()
    {
    	return $this->belongsTo('App\modeles\hospitalisation','id_hosp');
    }
    public function patient()
    {
      return $this->belongsTo('App\modeles\patient','pid');
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
      return $this->morphOne('App\modeles\demandeexb', 'imageable');
    }
    public function demandExmImg()
    { 
      return $this->morphOne('App\modeles\demandeexr','imageable');
    }
    public function medecin(){
          return $this->belongsTo('App\modeles\employ','id_employe');
    }
    public function prescreptionconstantes()
    {
      return $this->hasOne('App\modeles\prescription_constantes','visite_id');
    }
}
