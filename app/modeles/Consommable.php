<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class Consommable extends Model
{
    protected $table = 'consommable';
    public $timestamps = false;
    protected $fillable = ['nom'];
}
