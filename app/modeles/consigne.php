<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class consigne extends Model
{
    //
	 public $timestamps = false;
     protected $fillable  = ['consigne','id_visite','momments','duree'];
}
