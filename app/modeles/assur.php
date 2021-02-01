<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class assur extends Model
{
	public $timestamps = false;
	protected $primaryKey = 'NSS';
	protected $fillable = ['Nom','Prenom','Date_Naissance', 'lieunaissance','SituationFamille', 'Sexe','Matricule','adresse','commune_res','wilaya_res','grp_sang','NSS','NMGSN','Grade','Service','Position'];
	public function lieuNaissance()
	{
		return $this->belongsTo('App\modeles\Commune','lieunaissance');
	}
	public function grade()
	{
		return $this->belongsTo('App\modeles\grade','Grade');
	}
	public function commune()
	{
		if(isset($this->commune_res))
			return $this->belongsTo('App\modeles\Commune','commune_res');
	}
	public function wilaya()
	{	
		if(isset($this->wilaya_res))
			return $this->belongsTo('App\modeles\Wilaya','wilaya_res');
	}
	public function patients()
	{
		return $this->hasMany('App\modeles\patient','Assurs_ID_Assure');
	}
}
