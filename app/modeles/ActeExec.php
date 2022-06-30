<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class ActeExec extends Model
{
  public $timestamps = true;
  protected $fillable  = ['id','acte_id','employ_id','does','obs','ordre','state'];
  public function Employ()
  {
    return $this->belongsTo('App\modeles\employ','employ_id');
  }
  public function Acte()
  {
    return $this->belongsTo('App\modeles\Acte','acte_id');
  }
}
