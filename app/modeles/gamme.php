<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class gamme extends Model
{
    public $timestamps = false;
    protected $table = "gammes";
    protected $fillable = ['gamme'];
}
