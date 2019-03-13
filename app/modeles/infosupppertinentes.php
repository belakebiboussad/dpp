<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class infosupppertinentes extends Model
{
    public $timestamps = false;
    protected $table = "infosupppertinentes";
    protected $fillable = ['nom'];
}
