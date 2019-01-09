<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class demande_dispositif extends Model
{
    public $table ="demande_dispositif";
	public $timestamps = false;
    protected $fillable  = ['id_demande','id_dispositif','qte'];
}
