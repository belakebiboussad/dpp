<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class rdv extends Model
{
    public $timestamps = false;
    protected $fillable =['Date_RDV','Temp_rdv','specialite', 'Patient_ID_Patient','Employe_ID_Employe','Etat_RDV'];
}
