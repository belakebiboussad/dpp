<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class Etablissement extends Model
{
  public $timestamps = false;
  protected $table = "etablissement";
  protected $fillable = ['nom','adresse','tel','tel2','tutelle','logo'];// public function logo() //   return  url('').'/storage/'.$this->logo; // }
}
