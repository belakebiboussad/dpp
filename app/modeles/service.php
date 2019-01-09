<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class service extends Model
{
    public $timestamps = false;
    protected $fillable = ['nom'];
}
