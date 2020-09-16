<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class employ extends Model
{
    public $timestamps = false;
    protected $fillable = ['nom','prenom','sexe','Date_Naiss','Lieu_Naissance', 'Adresse','Tele_fixe','tele_mobile','specialite','service','Matricule_dgsn','NSS'];
    public function Service()
    {
             return $this->belongsTo('App\modeles\service','service');
    }
    public function specialite()
    {
    	return $this->belongsTo('App\modeles\Specialite','specialite');
    }
    public function rdvs()
    {
       return $this->hasMany('App\modeles\rdv','Employe_ID_Employe');// ->orderBy('Date_RDV')     
    }
} 

