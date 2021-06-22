<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class employ extends Model
{
	public $timestamps = false;
	protected $fillable = ['nom','prenom','sexe','Date_Naiss','Lieu_Naissance', 'Adresse','Tele_fixe','tele_mobile','specialite','service','Matricule_dgsn','NSS'];
	public function Service()
	{
	     return $this->belongsTo('App\modeles\service','service');
	} 
	public function Specialite()
	{
		return $this->belongsTo('App\modeles\Specialite','specialite');
	}
	public function rdvs()
	{
	   return $this->hasMany('App\modeles\rdv','Employe_ID_Employe')->where('Etat_RDV',null)->orwhere('Etat_RDV',1);//->where('Etat_RDV','!=','0' ->orderBy('Date_RDV')     
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

