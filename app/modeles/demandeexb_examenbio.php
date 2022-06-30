<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class demandeexb_examenbio extends Model
{
  public $timestamps = false;
  protected $table = "demandeexb_examenbio";
  protected $fillable = ['id_demandeexb','id_examenbio']; 
}
