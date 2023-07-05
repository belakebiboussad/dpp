<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class Reactif extends Model
{
  	public $timestamps = false;
    protected $fillable = ['nom','code'];
}
