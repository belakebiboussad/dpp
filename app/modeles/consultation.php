<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class consultation extends Model
{
    public $timestamps = false;
    protected $fillable =['isOriented','lettreorientaioncontent','Motif_Consultation','histoire_maladie','Date_Consultation','Diagnostic','id_code_sim','Resume_OBS','Employe_ID_Employe','Patient_ID_Patient','id_lieu','modeAdmission'];
    public function ordonnance()
    {
           return $this->hasOne('App\modeles\ordonnance','id_consultation');
    }
}
  