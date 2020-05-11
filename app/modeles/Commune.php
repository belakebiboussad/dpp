<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class Commune extends Model
{
   public $timestamps = false;
    protected $table = 'communes';
   protected $fillable = ['id','nom_commune','Id_daira'];
}
