<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class demande_medicaments extends Model
{
   	public $table ="demande_medicaments";
	public $timestamps = false;
    protected $fillable  = ['id_demande','id_medicaments','qte','qteDonne'];
}
