<?php

namespace App\modeles;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class patient extends Model
{
   	public $timestamps = false;
  	protected $fillable = ['code_barre','Nom','Prenom','nom_jeune_fille','Dat_Naissance','Lieu_Naissance','Sexe','situation_familiale' ,'Adresse','commune_res','wilaya_res','tele_mobile1','tele_mobile2','NSS','group_sang','rhesus','Assurs_ID_Assure','Type','Type_p','description','active','Date_creation'];
  	public function getAge(){	
    		return (Carbon::createFromDate(date('Y', strtotime($this->Dat_Naissance)), date('m', strtotime($this->Dat_Naissance)), date('d', strtotime($this->Dat_Naissance)))->age);
	}
	public function lieuNaissance()
	{
		if(isset($this->Lieu_Naissance))
			return $this->belongsTo('App\modeles\Commune','Lieu_Naissance');
	}
	public function commune()
	{
		if(isset($this->commune_res))
			return $this->belongsTo('App\modeles\Commune','commune_res','id');
	}
	public function wilaya()
	{	
		if(isset($this->wilaya_res))
			return $this->belongsTo('App\modeles\Wilaya','wilaya_res');
	}

}
