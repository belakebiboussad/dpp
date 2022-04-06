<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class Traitement extends Model
{
   	public $timestamps = false;
      protected $fillable  = ['id','med_id','posologie','periodes','duree','visite_id'];
      protected $casts = ['periodes' => 'array'];
     public function medicament()
     {
           return $this->belongsTo('App\modeles\medcamte','med_id');
     }
     public function visite()
	{
		return $this->belongsTo('App\modeles\visite','visite_id');
	}
}
