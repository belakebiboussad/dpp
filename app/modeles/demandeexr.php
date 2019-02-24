<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class demandeexr extends Model
{
    public $timestamps = false;
    protected $table = "demandeexr";
    protected $fillable = ['Date', 'InfosCliniques', 'Explecations', 'etat', 'resultat', 'id_consultation'];

    public function examensradios()
    {
        return $this->belongsToMany('App\modeles\examenradiologique', 'demandeexr_examenradio', 'id_demandeexr', 'id_examenradio');       
    }

    public function examensrelatifsdemande()
    {
        return $this->belongsToMany('App\modeles\exmnsrelatifdemande', 'demandeexradio_exmnsrelatifdemande', 'id_demandeexradio', 'id_examensrelatifdemande');       
    }

    public function infossuppdemande()
    {
        return $this->belongsToMany('App\modeles\infosupppertinentes', 'demandeexradio_infosupppertinentes', 'id_demandeexr', 'id_infosupp');       
    }

    public function consultation()
    {
        return $this->belongsTo('App\modeles\consultation','id_consultation');
    }

}
