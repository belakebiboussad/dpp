<?php

namespace App\modeles\CIM;

use Illuminate\Database\Eloquent\Model;

class sChapitre extends Model
{
	protected $connection = 'mysql2';
	protected $table = 'sous_chapitres';
	protected $primaryKey = 'C_S_CHAPITRE';
  public $timestamps = false; //protected $fillable = ['TITRE_CHAPITRE','	PLAGE_C'];
  public function chapitre()
  {
    return $this->belongsTo('App\modeles\CIM\chapitre','C_CHAPITRE');
  }
  public function maladies()
  {
  	return $this->hasMany('App\modeles\CIM\maladie','C_S_CHAPITRE');
  }
}