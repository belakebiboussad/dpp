<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class ordonnance extends Model
{
    public $timestamps = false;
    protected $fillable = ['duree','medicaments','id_consultation'];
}
