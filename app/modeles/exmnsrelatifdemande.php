<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class exmnsrelatifdemande extends Model
{
    public $timestamps = false;
    protected $table = "exmnsrelatifdemande";
    protected $fillable = ['nom'];
}
