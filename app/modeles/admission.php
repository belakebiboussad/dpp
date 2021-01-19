<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class admission extends Model
{
     public $timestamps = false;//     
     protected $fillable  = ['id','demande_id','id_rdvHosp','id_lit','etat'];
     public function lit()
     {
      	return $this->belongsTo('App\modeles\Lit','id_lit');
     }/*public function demandeHospitalisation(){return $this->belongsTo('App\modeles\DemandeHospitalisation','id_demande');}*/
     public function rdvHosp()
     {
          return $this->belongsTo('App\modeles\rdv_hospitalisation','id_rdvHosp');
     }
     public function RDVs() { return $this->hasMany('App\modeles\rdv_hospitalisation','id_admission')->orderBy('date_RDVh'); }
     public function hospitalisation(){ return $this->hasOne('App\modeles\hospitalisation');}
}
