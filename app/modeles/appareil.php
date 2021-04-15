<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class appareil extends Model
{
  //
  public $timestamps = false;
  protected $fillable = ['nom'];
}
