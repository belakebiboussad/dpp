<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class prescription_constantes extends Model
{
  protected $table = 'prescription_constantes';
  public $timestamps = false;
  protected $fillable = ['visite_id', 'observation'];
  public function Visite()
  {
       return $this->belongsTo('App\modeles\visite','visite_id');
  }
  public function constantes()
  {
        return $this->belongsToMany('App\modeles\Constante', 'pres_cons', 'prescription_id', 'cons_id');
  }
}