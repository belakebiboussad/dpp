<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class etabtype extends Model
{
  public $timestamps = false;//protected $table = "etat_sortie";
  protected $fillable = ['nom','acr'];
}
