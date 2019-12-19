<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class assur extends Model
{
  public $timestamps = false;
  protected $fillable = ['Nom','Prenom','Date_Naissance', 'lieunaissance', 'Sexe','Matricule','NSS','NMGSN','Grade','Etat'];
  public function lieuNaissance()
	{
	  	if(isset($this->lieunaissance))
			return $this->belongsTo('App\modeles\Commune','lieunaissance');
	}
	public function grade()
	{
			return $this->belongsTo('App\modeles\grade','Grade');
	}
}
