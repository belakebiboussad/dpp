<?php
namespace App\modeles;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class patient extends Model
{
  public $timestamps = false;
  protected $fillable = ['IPP','Nom','Prenom','nom_jeune_fille','Dat_Naissance','Lieu_Naissance','Sexe','situation_familiale' ,'Adresse','commune_res','wilaya_res','wilaya_res','tele_mobile1','tele_mobile2','NSS','group_sang','rhesus','Assurs_ID_Assure','Type','description','active','Date_creation','updated_at'];
  public function getAge(){	
    if(isset($this->Dat_Naissance))
    	return (Carbon::createFromDate(date('Y', strtotime($this->Dat_Naissance)), date('m', strtotime($this->Dat_Naissance)), date('d', strtotime($this->Dat_Naissance)))->age);
    else
    	return "NAN";
	}
	public function lieuNaissance()
	{
		return $this->belongsTo('App\modeles\Commune','Lieu_Naissance');
	}
	public function antecedants()
	{
		return $this->hasMany('App\modeles\antecedant','Patient_ID_Patient');
	}
	public function commune()
	{
			return $this->belongsTo('App\modeles\Commune','commune_res');
	}
	public function wilaya()
	{	
		if(isset($this->wilaya_res))
			return $this->belongsTo('App\modeles\Wilaya','wilaya_res');
	}
	public function assure()
	{	
		if(isset($this->Assurs_ID_Assure))
			return $this->belongsTo('App\modeles\assur','Assurs_ID_Assure');//return $this->belongsTo('App\modeles\assur','Assurs_ID_Assure');
	}
	public function hommesConf()
 	{
   		 return $this->hasMany('App\modeles\homme_conf','id_patient');
 	}
 	public function Consultations()
 	{
 		 return $this->hasMany('App\modeles\consultation','Patient_ID_Patient');
 	}
 	public function rdvs()
 	{
 		 return $this->hasMany('App\modeles\rdv','Patient_ID_Patient');
 	}
 	public function hospitalisations()
 	{
 		 return $this->hasMany('App\modeles\hospitalisation','patient_id');
 	}
 	public function facteurRisque()
 	{
 		 return $this->hasOne('App\modeles\facteurRisqueGeneral','patient_id');
 	}
 	public function getCivilite()
 	{
		if(isset($this->Dat_Naissance))
 		{
 			if($this->getAge() >16)
 			{
	 			if($this->Sexe == "F")
 					if($this->situation_familiale== "celibataire")
 						return "Mlle.";
 					else
 						return "Mme.";
 				else
 					return "M.";	
 			}else
 				return 'Enf.';
 		}else
 		{
 			if($this->Sexe == "F")
 				return "Mme";
 			else
 				return "M.";
 		}
 	}
}
