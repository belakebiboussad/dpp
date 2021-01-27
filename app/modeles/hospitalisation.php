<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class hospitalisation extends Model
{
    public $timestamps = false;
    protected $fillable  = ['id','Date_entree','Date_Prevu_Sortie','Date_Sortie','patient_id','id_admission','heure_entrée', 'Heure_Prevu_Sortie', 'Heure_sortie', 'etat_hosp','modeHosp_id','garde_id','remumeSortie','etatSortie','modeSortie','diagSortie','ccimdiagSortie','strucTransfert'];
    public function admission()
    {
     	return $this->belongsTo('App\modeles\admission','id_admission');
    }
    public function visites()
    {
        return $this->hasMany('App\modeles\visite','id_hosp');
    }
    public function garde()
    {
        return $this->belongsTo('App\modeles\homme_conf','garde_id');
    }
    public function patient()
    {
        return $this->belongsTo('App\modeles\patient','patient_id');
    }
    public function modeHospi()
    {
        return $this->belongsTo('App\modeles\ModeHospitalisation','modeHosp_id');
    }                      
}
