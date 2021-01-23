<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class Etatsortie extends Model
{
    public $timestamps = false;
    protected $table = "etat_sortie";
    protected $fillable = ['titre','description','typeEtat','datafile','id_visite'];

    public function visite()
    {
        return $this->belongsTo('App\modeles\visite','id_visite');
    }

}

