<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class Commune extends Model
{
  public $timestamps = false;
  protected $table = 'communes';
  protected $fillable = ['nom_commune','Id_daira'];
  public daira()
  {
  		return $this->belongsTo('App\modeles\Daira','Id_daira');
  }
}
