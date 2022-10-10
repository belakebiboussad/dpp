<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class examen_cliniqu extends Model
{
  public $timestamps = false;
  protected $fillable = ['autre','etat','peaupha','id_consultation'];
  protected $table = 'examen_clinique';
  public function consultation()
  {
    return $this->belongsTo('App\modeles\consultation','id_consultation');
  }/*public function examsAppareil(){return $this->hasMany('App\modeles\examAppareil','examen_clinique_id');}*/
  public function Consts()
  {
    return $this->hasOne('App\modeles\Constantes','examCl_id');
  }
}
