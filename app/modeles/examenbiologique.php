<?php

namespace App\modeles;
use Illuminate\Database\Eloquent\Model;
class examenbiologique extends Model
{
    public $timestamps = false;
    protected $table = "examenbiologiques";
    protected $fillable = ['nom_examen', 'id_specialite_exb'];
}
