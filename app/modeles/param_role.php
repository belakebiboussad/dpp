<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class param_role extends Model
{
  public $timestamps = true;
  protected $table = "param_role";
  protected $fillable = ['param_id','role_id','value'];
  protected $primaryKey = ['param_id', 'role_id'];
  public  function parametre()
  {
    return $this->BelongsTo('App\modeles\Parametre','param_id');

  }
}
