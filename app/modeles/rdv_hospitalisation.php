<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class rdv_hospitalisation extends Model
{
    public $timestamps = false;
    protected $fillable  = ['id','date_RDVh','heure_RDVh','id_admission','etat_RDVh','date_Prevu_Sortie','heure_Prevu_Sortie'];
    public function admission()
    {
    		return $this->belongsTo('App\modeles\admission','id_admission');
    }
}
