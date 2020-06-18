<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class assur extends Model
{
	  public $timestamps = false;
	  protected $fillable = ['Nom','Prenom','Date_Naissance', 'lieunaissance', 'Sexe','Matricule','adresse','grp_sang','NSS','NMGSN','Grade','Service','Etat'];
	 public function lieuNaissance()
	{
		if(isset($this->lieunaissance))
		return $this->belongsTo('App\modeles\Commune','lieunaissance');
	}
	public function grade()
	{
		return $this->belongsTo('App\modeles\grade','Grade');
	}
	public function patients()
	{
		return $this->hasMany('App\modeles\patient','Assurs_ID_Assure');
	}
	// public function service()
	// {
	// 		return $this->belongsTo('App\modeles\service','Grade');
	// }

}
