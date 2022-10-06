<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class Etablissement extends Model
{
  public $timestamps = false;
  protected $table = "etablissement";
  protected $fillable = ['nom','acronyme','adresse','type_id','tel','tel2','contact','tutelle','logo'];
  public function Type(){
      return $this->belongsTo('App\modeles\etabtype','type_id');
  } 
}
