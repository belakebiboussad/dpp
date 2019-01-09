<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class LettreOrientation extends Model
{
    //
	public $timestamps = false;
	protected $fillable  = ['motif','specialite','medecin','Consultation_ID_Consultation'];
	protected $table="lettre_oriantations";
}
