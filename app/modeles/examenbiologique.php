<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class examenbiologique extends Model
{
    public $timestamps = false;
    // protected $fillable = ['type', 'lien', 'description', 'Date', 'id_consultation'];
     protected $fillable = ['classe', 'nom','id_consultation'];
    protected $table = "examensBiologiques";
}
