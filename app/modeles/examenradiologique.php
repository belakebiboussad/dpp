<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class examenradiologique extends Model
{
    public $timestamps = false;
    protected $table = "examenradiologique";
    protected $fillable = ['nom'];
}
