<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class demande_reactif extends Model
{
    public $table ="demande_reactif";
	public $timestamps = false;
    protected $fillable  = ['id_demande','id_reactif','qte'];
}
