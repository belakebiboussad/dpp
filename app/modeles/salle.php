<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
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
  public function affectedBeds()
  {
    return $this->hasMany('App\modeles\Lit')->where('affectation',1);
  }
  public function blockedBeds()
  {
    return $this->hasMany('App\modeles\Lit')->where('bloq',1);
  }
}
