<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class Dispositif extends Model
{
    public $timestamps = false;
    protected $fillable = ['nom','code'];
}
