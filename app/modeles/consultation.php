<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class consultation extends Model
{
    public $timestamps = false;
    protected $fillable =['isOriented','lettreorientaioncontent','Motif_Consultation','histoire_maladie','Date_Consultation','Diagnostic',
                          'id_code_sim','Resume_OBS','Employe_ID_Employe','Patient_ID_Patient','id_lieu','modeAdmission'];
    public function docteur()
    {
        return $this->belongsTo('App\modeles\employ','Employe_ID_Employe');
    }

    public function patient()
    {
        return $this->belongsTo('App\modeles\patient','Patient_ID_Patient');
    }
    public function demandeexmbio()
    {
        return $this->hasMany('App\modeles\demandeexb','id_consultation');
    }

    public function examensradiologiques()
    {
        return $this->hasMany('App\modeles\demandeexr','id_consultation');
    }

    public function ordonnances()
    {
           return $this->hasOne('App\modeles\ordonnance','id_consultation');
    }
    public function lieu()
    {
           return $this->belongsTo('App\modeles\Lieuconsultation','id_lieu');
    }
    public function ordonnaces()
    {
        return $this->hasMany('App\modeles\ordonnance','id_consultation');
    }
}
  