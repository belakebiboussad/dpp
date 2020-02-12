<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class hospitalisation extends Model
{
    public $timestamps = false;
    //protected $fillable  = ['Date_entree','Motif','Date_Prevu_Sortie','Date_Sortie','id_demande'];
    protected $fillable  = ['id','Date_entree','Date_Prevu_Sortie','Date_Sortie','id_admission','heure_entrée', 'Heure_Prevu_Sortie', 'Heure_sortie', 'etat_hosp','garde_id'];
    public function admission()
    {
     	return $this->belongsTo('App\modeles\admission','id_admission');
    }
    public function vistes()
    {
        return $this->hasMany('App\modeles\visite','id_hosp');
    }
    public function garde()
    {
    	return $this->belongsTo('App\modeles\homme_conf','garde_id');
    }                       
}
