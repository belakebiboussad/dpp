<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class Vaccin extends Model
{
  public $timestamps = false;
  protected $table = "vaccins";
  protected $fillable = ['nom'];
}
