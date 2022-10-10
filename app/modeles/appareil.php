<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class appareil extends Model
{
  public $timestamps = false;
  protected $fillable = ['nom'];
  public function consultations()
  {
    return $this->belongsToMany('App\modeles\consultation','examen_appareil','cons_id','appareil_id');//->withPivot('description');
  }
}
