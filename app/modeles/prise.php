<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class prise extends Model
{
    //
	public $timestamps = false;
     protected $fillable  = ['id','id_consigne','periode','app','observation','date','heure','id_employe'];
}
