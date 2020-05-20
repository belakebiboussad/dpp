<?php

namespace App\modeles;
use Illuminate\Database\Eloquent\Model;
class demandeexb extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'id_demandeexb';
    protected $table = "demandeexb";
    protected $fillable = ['DateDemande', 'etat', 'resultat', 'id_consultation'];

    public function examensbios()
    {
        return $this->belongsToMany('App\modeles\examenbiologique', 'demandeexb_examenbio', 'id_demandeexb', 'id_examenbio');       
    }

    public function consultation()
    {
        return $this->belongsTo('App\modeles\consultation','id_consultation');
    }
}