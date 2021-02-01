<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class examen_cliniqu extends Model
{
    public $timestamps = false;
    protected $fillable = ['taille','poids','temp','autre','IMC','Etat','peaupha','id_consultation'];
    protected $table = 'examen_clinique';
    public function consultation()
    {
    	return $this->belongsTo('App\modeles\consultation','id_consultation');
    } 
}
