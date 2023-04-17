<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class Appareil extends Model
{
  public $timestamps = false;
  protected $fillable = ['nom'];
}
