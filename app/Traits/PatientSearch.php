<?php
namespace App\Traits;
use  App\modeles\patient;
trait PatientSearch
{
    public function patientSearch($prenom , $NSSAssre)
    {
        $patient = patient::where('Prenom','LIKE','%'.trim($prenom)."%")
                    ->where('Assurs_ID_Assure','LIKE','%'.trim($NSSAssre)."%")    
                    ->select('patients.id')->get()->first(); 
        if(isset($patient))
          return $patient->id;
        else 
         return null;  
    }
}
