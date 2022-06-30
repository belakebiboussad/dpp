<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class demande_consomable extends Model
{
    public $table ="demande_consomable";
	public $timestamps = false;
    protected $fillable  = ['id_demande','id_consomable','qte','unite','qteDonne'];
}
