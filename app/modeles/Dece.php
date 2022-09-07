<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class Dece extends Model
{
  public $timestamps = false;
  protected $fillable = ['date','heure','cause','med_id','hosp_id'];
  public function hospitalisation()
  {
    return $this->belongsTo('App\modeles\hospitalisation','hosp_id');
  }
  public function Medecin()
  {
    return $this->belongsTo('App\modeles\employ','med_id');
  }
}