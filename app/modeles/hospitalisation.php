<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class hospitalisation extends Model
{
     public $timestamps = false;
     protected $fillable  = ['Date_entree','Motif','Date_Prevu_Sortie','Date_Sortie','id_demande'];
}
