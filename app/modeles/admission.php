<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class admission extends Model
{
     public $timestamps = false;
     protected $fillable  = ['id','id_demande','id_lit'];
}
