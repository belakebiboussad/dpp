<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;
use App\modeles\Wilaya;
use Carbon\Carbon;
class patient extends Model
{
   	 public $timestamps = false;
  	  protected $fillable = ['code_barre','Nom','Prenom','nom_jeune_fille','Dat_Naissance','Lieu_Naissance','Sexe','situation_familiale' ,'Adresse','commune_res','wilaya_res','tele_mobile1','tele_mobile2','NSS','group_sang','rhesus','Assurs_ID_Assure','Type','Type_p','description','active','Date_creation'];
  	  public function getAge(){	
    		return (Carbon::createFromDate(date('Y', strtotime($this->Dat_Naissance)), date('m', strtotime($this->Dat_Naissance)), date('d', strtotime($this->Dat_Naissance)))->age);

	}
	public function wilaya()
	{
		return $this->belongsTo('Wilaya');
	}
}
