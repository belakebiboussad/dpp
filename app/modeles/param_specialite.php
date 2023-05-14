<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class param_specialite extends Model
{
  public $timestamps = true;
  protected $table = "param_specialite";
  protected $fillable = ['param_id','spec_id','value'];
  public  function Parametre()
  {
    return $this->BelongsTo('App\modeles\Parametre','param_id');
  }
  public  function Specialite()
  {
    return $this->BelongsTo('App\modeles\Specialite','spec_id');
  }
}
