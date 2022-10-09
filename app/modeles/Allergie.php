<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class Allergie extends Model
{
  public $timestamps = false;
  protected $table = "allergies";
  protected $fillable = ['nom'];
}
