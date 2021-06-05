<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class NGAP extends Model
{
  public $timestamps = false;
  protected $table="ngap";
  protected $fillable  = ['code','libelle','lettre_cle','tarif'];
}
