<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class Dece extends Model
{
  public $timestamps = false;
  protected $fillable = ['date','heure','cause','med_id','hosp_id'];
  protected $dates =['date'];
  public function getHeurFormattedAttribute()
  {
    return \Carbon\Carbon::parse($this->heure)->format('H:i');
  }
  public function hospitalisation()
  {
    return $this->belongsTo('App\modeles\hospitalisation','hosp_id');
  }
  public function Medecin()
  {
    return $this->belongsTo('App\modeles\employ','med_id');
  }
}
