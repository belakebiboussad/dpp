<?php
namespace App\modeles;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class patient extends Model
{
	public $timestamps = true;
	protected $fillable = ['IPP','Nom','Prenom','nom_jeune_fille','dob','pob','Sexe','sf' ,'Adresse','commune_res','mob','mob2','NSS','gs','rh','assur_id','nationalite','prof_id','type_id','description','active'];
  protected $dates =['dob'];
  protected $appends = ['full_name','age','civ'];
  public function scopeActive($q)
  {
    return $q->where('active',1);
  }
  public function getFullNameAttribute()
  {
    return $this->Nom." ".$this->Prenom ;
  }
  public function getAgeAttribute(){ 
    if(isset($this->dob))
      return (Carbon::createFromDate(date('Y', strtotime($this->dob)), date('m', strtotime($this->dob)), date('d', strtotime($this->dob)))->age);
    else
    return "99";
  }
  public function getCivAttribute()
  { 
    switch ($civilite = $this->getCivilite()) {
        case 'M.': //$civcode = 1; 
          return 1;
          break;
        case 'Mlle.'://$civcode =2; 
        case 'Mme.':
          return 2;
          break; 
        case 'Enf.':// $civcode =3; 
          return 3;
          break;
        default :
          return 1;
          break;     
    }
  }
  public function POB()
	{
		return $this->belongsTo('App\modeles\Commune','pob');
	}
	public function commune()
	{
			return $this->belongsTo('App\modeles\Commune','commune_res');
	}
	/*
  public function wilaya()
	{	
		if(isset($this->wilaya_res))
			return $this->belongsTo('App\modeles\Wilaya','wilaya_res');
	}
  */
  public function Type()
  {
      return $this->belongsTo('App\modeles\PatientType','type_id');
  }
  public function Profession()
  {
      return $this->belongsTo('App\modeles\Profession','prof_id');
  }
	public function assure()
	{	
		if(!is_null($this->assur_id))
			return $this->belongsTo('App\modeles\assur','assur_id');
	}
	public function hommesConf()
 	{
   		 return $this->hasMany('App\modeles\homme_conf','id_patient');
 	}
  public function antecedants()
  {
    return $this->hasMany('App\modeles\antecedant','pid');
  }
 	public function Consultations()
 	{
 		 return $this->hasMany('App\modeles\consultation','pid');
 	}
 	public function rdvs()
 	{
 		 return $this->hasMany('App\modeles\rdv','patient_id');
 	}
 	public function rdvsSpecialite ($id) {
   		return $this->hasMany('App\modeles\rdv')->where('specialite_id', $id);
	}
 	public function hospitalisations()
 	{
 		 return $this->hasMany('App\modeles\hospitalisation','patient_id');
 	}
 	public function facteurRisque()
 	{
 		 return $this->hasOne('App\modeles\facteurRisqueGeneral','patient_id');
 	}
  public function Allergies()
  {
    return $this->belongsToMany('App\modeles\Allergie','allergie_patient','patient_id','allergie_id')->withTimestamps();
  }
  public function vaccins()
  {
    return $this->belongsToMany('App\modeles\Vaccin','patient_vaccin','patient_id','vaccin_id')->withPivot('date')->withTimestamps();
  }
  public function ContagDesease()
  {
    return $this->belongsToMany('App\modeles\CIM\maladie','dppdb.maladie_patient','patient_id','maladie_id')->withTimestamps();
  }
  public function Mother()
  {
    return $this->hasOne('App\modeles\Mother','pid');
  }
 	public function getCivilite()
 	{
		if(isset($this->dob))
 		{
 			if($this->age >16)
 			{
	 			if($this->Sexe == "F")
 					if($this->sf== "celibataire")
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