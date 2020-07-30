<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class employ extends Model
{
    public $timestamps = false;
    protected $fillable = ['Nom_Employe','Prenom_Employe','Sexe_Employe','Date_Naiss_Employe','Lieu_Naissance_Employe', 'Adresse_Employe','Tele_fixe','tele_mobile','Specialite_Emploiye','Service_Employe','Matricule_dgsn','NSS'];
    public function service()
    {
             return $this->belongsTo('App\modeles\service','Service_Employe');
    }
    public function specialite()
    {
    	return $this->belongsTo('App\modeles\Specialite','Specialite_Emploiye');
    }
    public function rdvs()
    {
       return $this->hasMany('App\modeles\rdv','Employe_ID_Employe');// ->orderBy('Date_RDV')     
    }
} 

