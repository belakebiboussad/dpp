<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class Lit extends Model
{
    //etat si il est bloque,etat= 1 non bloque, etat=0  bloqué
    //affectation , affectation = 0 libre,affectation = 1 occupé 		
    public $timestamps = false;
    protected $fillable = ['num','nom','etat','affectation','salle_id'];
    public function salle() {
    	return $this->belongsTo('App\modeles\salle','salle_id');
    }
}
