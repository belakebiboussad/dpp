<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class antecType extends Model
{
       public $timestamps = false;
       protected $table = "antecTypes";
        protected $fillable = ['nom','nom_complet'];
}