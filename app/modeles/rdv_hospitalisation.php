<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class rdv_hospitalisation extends Model
{
    public $timestamps = false;
    protected $fillable  = ['id','date','heure','id_demande','etat','date_Prevu_Sortie','heure_Prevu_Sortie'];
    public function demandeHospitalisation()
    {
        return $this->belongsTo('App\modeles\DemandeHospitalisation','id_demande');
    }
    public function bedReservation()
    {
    	return $this->hasOne('App\modeles\BedReservation','id_rdvHosp');//hasOne
    }
     public function Admission()
     {
           return $this->hasOne('App\modeles\admission','id_rdvHosp');//hasOne
     }
}
