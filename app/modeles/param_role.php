<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class param_role extends Model
{
  public $timestamps = true;
  protected $table = "param_role";
  protected $fillable = ['param_id','rol_id','value'];
  public  function Parametre()
  {
    return $this->BelongsTo('App\modeles\Parametre','param_id');
  }
  public  function Role()
  {
    return $this->BelongsTo('App\modeles\rol','rol_id');
  }

}
