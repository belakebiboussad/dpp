<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class medecin_traitant extends Model
{
    //
       public $timestamps = false;
    protected $fillable  = ['id_colloque','id_demande','id_medecin'];
}
