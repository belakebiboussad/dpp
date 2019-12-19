<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class dem_colloque extends Model
{
    //
     public $timestamps = false;
     protected $fillable  = ['id_colloque','id_demande','id_medecin','ordre_priorite','observation'];
     public function demandeHosp()
     {
     	return $this->belongsTo('App\modeles\DemandeHospitalisation','id_demande');
     }
     public function medecin()
     {
     	return $this->belongsTo('App\modeles\employ','id_medecin');
     }
     public function colloque()
     {
          return $this->belongsTo('App\modeles\colloque','id_colloque');
     }

}
