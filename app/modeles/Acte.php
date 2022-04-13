<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class Acte extends Model
{
   	public $timestamps = false;
  	protected $fillable  = ['nom','id_visite','description','type','code_ngap','periodes','nbrJ',,'duree','retire'];
 	  public  $casts = [
 	     'periodes' => 'array'
 	  ];
		public function visite()
		{
			return $this->belongsTo('App\modeles\visite','id_visite');
		}
		public function CodeNGAP()
		{
			return $this->belongsTo('App\modeles\NGAP','code_ngap');
		}
}
