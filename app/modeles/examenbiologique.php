<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class examenbiologique extends Model
{
    public $timestamps = false;
    // protected $fillable = ['type', 'lien', 'description', 'Date', 'id_consultation'];
    //  protected $fillable = ['classe', 'nom','id_consultation'];
    // protected $table = "examensBiologiques";
      protected $table = "examenbiologiques";
    protected $fillable = ['nom_examen', 'id_specialite_exb'];
}
