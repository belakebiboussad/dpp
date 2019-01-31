<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class patient extends Model
{
   	 public $timestamps = false;
  	  protected $fillable = ['code_barre','Nom','Prenom','Dat_Naissance','Lieu_Naissance','Sexe','situation_familiale' ,'Adresse','tele_mobile1','tele_mobile2','NSS','group_sang','Rihesus','Assurs_ID_Assure','Type','Type_p','description','Date_creation'];
  	  public function getAge(){	
    		// $age =$now - $this->Dat_Naissance;
 		 // $this->Dat_Naissance->diff(Carbon::now())->format('%y years, %m months and %d days');
    		return (Carbon::createFromDate(date('Y', strtotime($this->Dat_Naissance)), date('m', strtotime($this->Dat_Naissance)), date('d', strtotime($this->Dat_Naissance)))->age);

	}
}
