<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class rdv_hospitalisation extends Model
{
     public $timestamps = false;
     protected $fillable  = ['id','date_RDVh','heure_RDVh','id_admission','etat_RDVh'];
}
