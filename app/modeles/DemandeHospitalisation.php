<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class DemandeHospitalisation extends Model
{
	protected $table = "demandehospitalisations";
 	public $timestamps = false;
 	protected $fillable = ['etat','service','specialite','modeAdmission','degree_urgence','id_consultation'];
   public function consultation()
     {
     		return $this->belongsTo('App\modeles\consultation','id_consultation');
     } 
}
