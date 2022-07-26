<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class examAppareil extends Model
{
	public $timestamps = false;
	protected $table = 'examen_appareil';
	protected $fillable = ['appareil_id','cons_id','description'];
	public function Appareil()
	{
  	return $this->belongsTo('App\modeles\appareil','appareil_id');
	}
  public function consultation()
  {
    return $this->belongsTo('App\modeles\consultation','cons_id');
  }
}