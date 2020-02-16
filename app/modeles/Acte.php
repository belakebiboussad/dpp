<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class Acte extends Model
{
    //
	public $timestamps = false;
  protected $fillable  = ['nom','id_visite','description','type','duree','periodes','retire'];
 //  public  $casts = [
 //   'periodes' => 'array'
	// ];
	public function actes()
	{
		return $this->belongsTo('App\modeles\visite','id_visite');
	}
}
