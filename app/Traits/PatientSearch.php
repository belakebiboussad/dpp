<?php
namespace App\Traits;
use  App\modeles\patient;
trait PatientSearch
{
    public function patientSearch($prenom , $NSSAssre)
    {
       $patient = patient::where('Prenom',trim($prenom))
                           ->where('Assurs_ID_Assure',trim($NSSAssre))    
                           ->select('patients.id')->get()->first(); 
        if(isset($patient))
          return $patient->id;
        else 
         return null;  
    }
}
