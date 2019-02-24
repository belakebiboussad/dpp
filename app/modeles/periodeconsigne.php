<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class periodeconsigne extends Model
{
    //
	public $timestamps = false;
     protected $fillable  = ['id_consigne','id_periode'];
}
