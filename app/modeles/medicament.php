<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class medicament extends Model
{
    public $timestamps = false;
    protected $fillable = ['Nom_com','Code_DCI','Forme','Dosage','Conditionnement'];
}
