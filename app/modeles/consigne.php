<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class consigne extends Model
{
    //
	 public $timestamps = false;
     protected $fillable  = ['id','consigne','id_visite','duree'];
}
