<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class consultation extends Model
{
    public $timestamps = false;
<<<<<<< HEAD
    protected $fillable =['isOriented','lettreorientaioncontent','Motif_Consultation','histoire_maladie','Date_Consultation','Diagnostic','id_code_sim','Resume_OBS','Employe_ID_Employe','Patient_ID_Patient','id_lieu','modeAdmission','isOriented'];

=======
    protected $fillable =['isOriented','lettreorientaioncontent','Motif_Consultation','histoire_maladie','Date_Consultation','Diagnostic',
                          'id_code_sim','Resume_OBS','Employe_ID_Employe','Patient_ID_Patient','id_lieu','modeAdmission'];
>>>>>>> dev
    public function docteur()
    {
        return $this->belongsTo('App\modeles\employ','Employe_ID_Employe');
    }

    public function patient()
    {
        return $this->belongsTo('App\modeles\patient','Patient_ID_Patient');
    }
<<<<<<< HEAD

=======
>>>>>>> dev
    public function demandeexmbio()
    {
        return $this->hasMany('App\modeles\demandeexb','id_consultation');
    }

    public function examensradiologiques()
    {
        return $this->hasMany('App\modeles\demandeexr','id_consultation');
    }

<<<<<<< HEAD
=======
    public function ordonnances()
    {
           return $this->hasOne('App\modeles\ordonnance','id_consultation');
    }
    public function lieu()
    {
           return $this->belongsTo('App\modeles\Lieuconsultation','id_lieu');
    }
>>>>>>> dev
    public function ordonnaces()
    {
        return $this->hasMany('App\modeles\ordonnance','id_consultation');
    }
}
  