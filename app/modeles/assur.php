<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class assur extends Model
{
   public $timestamps = false;
   protected $fillable = ['Nom','Prenom','Date_Naissance', 'lieunaissance', 'Sexe','Matricule','Service','NSS','NMGSN','Grade','Etat'];
}
