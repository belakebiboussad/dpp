<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class patient extends Model
{
    public $timestamps = false;
    protected $fillable = ['code_barre','Nom','Prenom','Dat_Naissance','Lieu_Naissance','Sexe','situation_familiale' ,'Adresse','tele_mobile1','tele_mobile2','NSS','group_sang','Rihesus','Assurs_ID_Assure','Type','Type_p','description','Date_creation'];
    
}
