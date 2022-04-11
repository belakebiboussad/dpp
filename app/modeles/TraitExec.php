<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class TraitExec extends Model
{
  public $timestamps = true;
  protected $fillable  = ['id','trait_id','employ_id','does','obs','state'];
  public function Employ()
  {
    return $this->belongsTo('App\modeles\employ','employ_id');
  }
  public function Trait()
  {
    return $this->belongsTo('App\modeles\Traitement','trait_id');
  }
}
