<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class consultation extends Model
{
        public $timestamps = false;
        protected $fillable =['isOriented','lettreorientaioncontent','motif','histoire_maladie','date','Diagnostic',
                              'id_code_sim','Resume_OBS','employ_id','pid','id_lieu'];//modeAdmission
        public function medecin()
        {
            return $this->belongsTo('App\modeles\employ','employ_id');
        }
        public function patient()
        {
            return $this->belongsTo('App\modeles\patient','pid');
        }
        public function demandeexmbio()
        {
            return $this->hasOne('App\modeles\demandeexb','id_consultation');
        }
        public function examensCliniques()
        {
            return $this->hasOne('App\modeles\examen_cliniqu','id_consultation');
        }
       public function examsAppareil()
        {
               return $this->hasMany('App\modeles\examAppareil','cons_id');
        }
       public function demandExmImg()//examensradiologiques()//used
       {
            return $this->hasOne('App\modeles\demandeexr','id_consultation');
      }
        public function examenAnapath()
        {
            return $this->hasOne('App\modeles\examenanapath','id_consultation');
        }
        public function ordonnances()
       { 
              return $this->hasOne('App\modeles\ordonnance','id_consultation');
        }
        public function lieu()
      {
            return $this->belongsTo('App\modeles\Etablissement','id_lieu');
      }
    public function demandeHospitalisation()
    {
      return $this->hasOne('App\modeles\DemandeHospitalisation','id_consultation');
    }/*public function ordonnaces(){return $this->hasMany('App\modeles\ordonnance','id_consultation');}*/
    public function lettreOrintation()
    {
      return $this->hasMany('App\modeles\LettreOrientation','consultation_id');
    }
}
  