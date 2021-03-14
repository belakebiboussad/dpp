<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class Etablissement extends Model
{
  public $timestamps = false;
  ptotected $table = "etablissement";
  protected $fillable = ['nom'];
}
