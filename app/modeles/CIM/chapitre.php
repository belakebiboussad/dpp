<?php

namespace App\modeles\CIM;

use Illuminate\Database\Eloquent\Model;

class chapitre extends Model
{
	protected $connection = 'mysql2';
	//protected $table = 'chapitres';
	protected $primaryKey = 'C_CHAPI';
  public $timestamps = false;
  //protected $fillable = ['TITRE_CHAPITRE','	PLAGE_C'];
  public function schapitres()
  {
  	return $this->hasMany('App\modeles\CIM\sChapitre','C_CHAPITRE');
  }
}