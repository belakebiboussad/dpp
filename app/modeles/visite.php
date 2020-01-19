<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class visite extends Model
{
  //
	public $timestamps = false;
  //protected $fillable  = ['id_visite','date_visite','heure_visite','id_hosp','id_employe'];
  protected $fillable  = ['date','heure','id_hosp','id_employe'];
}
