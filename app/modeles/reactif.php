<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class reactif extends Model
{
  	public $timestamps = false;
    protected $fillable = ['nom','code'];
}
