<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class Etablissement extends Model
{
  public $timestamps = false;
  protected $table = "etablissement";
  protected $fillable = ['nom','adresse','tel','logo'];
}
