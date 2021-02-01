<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class antecedant extends Model
{
  	  public $timestamps = false;
    	protected $fillable =['Antecedant','typeAntecedant','stypeatcd','date','cim_code','descrioption','Patient_ID_Patient','habitudeAlim','tabac','ethylisme'];
    	protected $table = "antecedants";
    	public function patient()
  	{
  		return $this->belongsTo('App\modeles\patient','Patient_ID_Patient');
  	}
}
