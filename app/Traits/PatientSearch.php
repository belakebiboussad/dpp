<?php
namespace App\Traits;
use  App\modeles\patient;
trait PatientSearch
{
    public function patientSearchByfirstName($prenom , $NSSAssure)
    {
      $patient = patient::where('Prenom',trim($prenom))
                        ->where('Assurs_ID_Assure',trim($NSSAssure))    
                        ->select('patients.id')->get()->first(); 
      if(isset($patient))
        return $patient->id;
      else 
        return null;  
    }
    public function patientSearchByType($type , $NSSAssure)
    {
      $patient = patient::where('Type',trim($type))
                        ->where('Assurs_ID_Assure',trim($NSSAssure))    
                        ->select('patients.id')->get()->first(); 
      if(isset($patient))
        return $patient->id;
      else 
        return null;  
    }
}
