<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class demandeexr extends Model
{
    public $timestamps = false;
    protected $table = "demandeexr";
    protected $fillable = ['InfosCliniques', 'Explecations', 'etat', 'resultat', 'id_consultation','visite_id'];

    public function examensradios()
    { //
      return $this->belongsToMany('App\modeles\examenradiologique', 'demandeexr_examenradio', 'id_demandeexr', 'id_examenradio')->withPivot('examsRelatif','resultat','etat','observation');       
    }

    public function typeExam()//exmnsrelatifdemande//demandeexradio_exmnsrelatifdemande
    {
        return $this->belongsToMany('App\modeles\TypeExam', 'examradio_typeExam', 'id_demandeexradio', 'id_typexam');       
    }
    public function infossuppdemande()
    {
        return $this->belongsToMany('App\modeles\infosupppertinentes', 'demandeexradio_infosupppertinentes', 'id_demandeexr', 'id_infosupp');       
    }
    public function consultation()
    {
        return $this->belongsTo('App\modeles\consultation','id_consultation');
    }
     public function visite()
    {
        return $this->belongsTo('App\modeles\visite','visite_id');
    }

}
