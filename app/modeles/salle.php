<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class salle extends Model
{
     public $timestamps = false;
    protected $fillable = ['num','nom','max_lit','bolc','etage','etat','service_id'];
    public function lits(){
    	return $this->hasMany('App\modeles\Lit');
    }
    // id_service
     public function service()
      {
    	return $this->belongsTo('App\modeles\service','service_id');
    }		 
}
