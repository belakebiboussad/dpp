<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class Etatsortie extends Model
{
    public $timestamps = false;
    protected $table = "etat_sortie";
    protected $fillable = ['titre','description','type'];
}

