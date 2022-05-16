<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class LettreOrientation extends Model
{
  public $timestamps = false;
	protected $fillable  = ['motif','specialite','consultation_id'];
	protected $table="lettre_oriantations";
	public function consultation()
  {
   	return $this->belongsTo('App\modeles\consultation','consultation_id');
  }
  public function Specialite()//comment
  {
  	return $this->belongsTo('App\modeles\Specialite','specialite');	
  }
}
