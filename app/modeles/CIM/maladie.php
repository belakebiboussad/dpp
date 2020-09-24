<?php

namespace App\modeles\CIM;

use Illuminate\Database\Eloquent\Model;
class maladie extends Model
{
	protected $connection = 'mysql2';//protected $table = 'malad';
	//protected $primaryKey = 'CODE_DIAG';
  public $timestamps = false;
  protected $fillable = ['CODE_DIAG','C_S_CHAPITRE','NOM_MALADIE'];
  public function sChapitre()
  {
    return $this->belongsTo('App\modeles\CIM\sChapitre',' C_S_CHAPITRE');
  }
}