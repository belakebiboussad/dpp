<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class Constontes extends Model
{
    protected $table = 'constantes';
    public $timestamps = false;
    protected $fillable = ['poid', 'taille', 'pas', 'pad', 'pouls', 'temp', 'glycemie', 'cholest', 'date_prise', 'patient_id', 'consultation_id', 'hospitalisation_id'];
}
