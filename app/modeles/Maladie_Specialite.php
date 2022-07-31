<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class modelesMaladie_Specialite extends Model
{
  //
  public $timestamps = false;
  protected $table = "maladie_specialite";
  protected $fillable = ['maladie_id','specialite_id'];
    public function Maladie()
  {
    return $this->belongsTo('App\modeles\CIM\maladie','maladie_id');
  }
  public function Specialite()
  {
    return $this->belongsTo('App\modeles\Specialite','specialite_id');
  }
}
