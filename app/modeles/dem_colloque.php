<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class dem_colloque extends Model
{
    //
     public $timestamps = false;
     protected $fillable  = ['id_colloque','id_demande','medcin_traitant','ordre_priorite','observation'];
}
