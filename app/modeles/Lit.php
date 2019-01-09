<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class Lit extends Model
{
    public $timestamps = false;
    protected $fillable = ['num','etat','affectation','id_salle'];
}
