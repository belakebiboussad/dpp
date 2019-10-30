<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class admission extends Model
{
     public $timestamps = false;
     protected $fillable  = ['id','id_demande','id_lit'];
     public function lit()
     {
      	return $this->belongsTo('App\modeles\Lit','id_lit');
     }
     public function demandeHospitalisation()
     {
     		return $this->belongsTo('App\modeles\DemandeHospitalisation','id_demande');
     }
     
}
