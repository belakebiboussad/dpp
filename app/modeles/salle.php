<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;
class salle extends Model
{
  public $timestamps = false;
  protected $fillable = ['num','nom','genre','max_lit','bloc','etage','etat','service_id'];
  public function lits(){
         return $this->hasMany('App\modeles\Lit');
  }
  public function service()
  {
    return $this->belongsTo('App\modeles\service','service_id');
  }		 
}
