<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class bedAffectation extends Model
{
  public $timestamps = false;
	protected $table = 'bedAffectation';
  protected $fillable  = ['demande_id','lit_id'];
  public function lit()
  {
  	return $this->belongsTo('App\modeles\Lit','lit_id');
  }
  public function demandeHosp()
  {
  	return $this->belongsTo('App\modeles\DemandeHospitalisation','demande_id');
  }
}
