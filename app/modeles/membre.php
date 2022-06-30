<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class membre extends Model
{
     public $timestamps = false;
     protected $fillable  = ['id_colloque','id_employ'];
}
