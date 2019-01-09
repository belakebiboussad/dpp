<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class medcamte extends Model
{
    public $timestamps = false;
    protected $fillable = ['id_gamme','id_specialite','code_produit','dci'];

    public function specialite()
    {
        return $this->belongsTo('App\modeles\specialite_produit', 'id_specialite');
    }

    public function gamme()
    {
        return $this->belongsTo('App\modeles\gamme', 'id_gamme');
    }
}
