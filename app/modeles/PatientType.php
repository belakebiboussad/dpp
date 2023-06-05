<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class PatientType extends Model
{
  public $timestamps = false;
  protected $table = "patient_tpe";
  protected $fillable = ['nom'];
}
