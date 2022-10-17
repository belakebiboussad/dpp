<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class antecedant extends Model
{
  public $timestamps = false;
	protected $fillable =['Antecedant','typeAntecedant','stypeatcd','date','cim_code','description','pid','habitudeAlim','tabac','ethylisme'];
	protected $table = "antecedants";
	public function patient()
  {
  	return $this->belongsTo('App\modeles\patient','pid');
  }
}
