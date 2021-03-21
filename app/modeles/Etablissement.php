<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class Etablissement extends Model
{
  public $timestamps = false;
  protected $table = "etablissement";
  protected $fillable = ['nom','adresse','tel','tutelle','logo'];
  public function logo()
  {
    // return 'http://10.1.79.28:8000/storage/'.$this->logo;
    return  url('').'/storage/'.$this->logo;
  }
}
