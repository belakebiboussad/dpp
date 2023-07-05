<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class Drug extends Model
{
     public $timestamps = false;
     protected $fillable = ['nom','code_produit','code_enr','Affectation','id_specialite'];
    public function specialite()
    {
        return $this->belongsTo('App\modeles\specialite_produit', 'id_specialite');
    }
}
