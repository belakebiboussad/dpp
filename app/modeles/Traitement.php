<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class Traitement extends Model
{
    //
	public $timestamps = false;
  protected $fillable  = ['id','med_id','periodes','duree','visite_id'];
  protected $casts = [
        'periodes' => 'array',
  ];
  public function visite()
	{
		return $this->belongsTo('App\modeles\visite','id_visite');
	}
}
