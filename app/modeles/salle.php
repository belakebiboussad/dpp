<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class salle extends Model
{
     public $timestamps = false;
    protected $fillable = ['num','nom','max_lit','bolc','etage','etat','id_service'];
}
