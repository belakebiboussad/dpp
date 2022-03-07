<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class consts extends Model
{
  protected $table = 'const';
  public $timestamps = false;
  protected $fillable = ['name'];
}
