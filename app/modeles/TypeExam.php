<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class TypeExam extends Model
{
  public $timestamps = false;
  protected $table = "typesExam";
  protected $fillable = ['nom'];
}
