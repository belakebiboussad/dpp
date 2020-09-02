<?php

namespace App\modeles\CIM;

use Illuminate\Database\Eloquent\Model;

class chapitre extends Model
{
	protected $connection = 'mysql2';
	protected $table = 'chapitre';
	protected $primaryKey = '	C_CHAPI';
  public $timestamps = false;
  protected $fillable = ['TITRE_CHAPITRE','	PLAGE_C'];
}