<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class employ extends Model
{
	public $timestamps = false;
	protected $fillable = ['nom','prenom','sexe','Date_Naiss','Lieu_Naissance', 'Adresse','Tele_fixe','tele_mobile','specialite','service_id','Matricule_dgsn','NSS'];
	protected $appends = ['full_name'];
  public function getFullNameAttribute()
  {
    return $this->nom." ".$this->prenom ;
  }
  public function Service()
	{
	  return $this->belongsTo('App\modeles\service','service_id');
	} 
	public function Specialite()
	{
		return $this->belongsTo('App\modeles\Specialite','specialite');
	}
	public function rdvs()
	{
	  return $this->hasMany('App\modeles\rdv','employ_id')->where('etat',null)->orwhere('etat',1);
	}
	public function User()
	{
		return $this->hasOne('App\User','employee_id');
	}
	 public function colloques()
	{
		return $this->belongsToMany ('App\modeles\colloque','membres','id_employ','id_colloque');
	}
} 

