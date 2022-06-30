<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class Parametre extends Model
{
  public $timestamps = false;
  protected $fillable = ['id','nom','label','type','value','role_id'];
  public function role()
  {
    return $this->belongsTo('App\modeles\rol','role_id');
  } 
}
