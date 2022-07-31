<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class bedAffectation extends Model
{
  public $timestamps = true;
	protected $table = 'bedAffectation';
  protected $fillable  = ['demande_id','lit_id','state'];//null en cours 1 temine
  public function Lit()
  {
  	return $this->belongsTo('App\modeles\Lit','lit_id');
  }
  public function demandeHosp()
  {
  	return $this->belongsTo('App\modeles\DemandeHospitalisation','demande_id');
  }
}
