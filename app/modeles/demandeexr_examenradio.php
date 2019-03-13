<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class demandeexr_examenradio extends Model
{
    public $timestamps = false;
    protected $table = "demandeexr_examenradio";
    protected $fillable = ['id_demandeexr','id_examenradio'];
}
