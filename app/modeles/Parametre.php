<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class Parametre extends Model
{
  public $timestamps = false;
  protected $fillable = ['id','nom','label','type'];
  public function roles()
  {
    return $this->hasMany('App\modeles\param_role','role_id')->withPivot('value');
  } 
}
