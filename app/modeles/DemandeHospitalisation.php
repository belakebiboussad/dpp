<?php
namespace App\modeles;
use Illuminate\Database\Eloquent\Model;
class DemandeHospitalisation extends Model
{
  public const MODESADMISSION = [
    0 => 'Programme',
    1 => 'Ambulatoire',
    2 => 'Urgence',
  ];
  public const STATES = [
    ''=> 'en Cours',
    0 => 'Annule',
    1 => 'Programme',
    2 => 'Admise',
    3 => 'Hospitalisation',
    4 => 'en Attente',
    5 => 'Valide'
  ];
  protected $table = "demandehospitalisations";
  public $timestamps = false;
  protected $fillable = ['etat','service','specialite','modeAdmission','degree_urgence','id_consultation','observation'];
  public function getEtatAttribute()
  {
    return self::STATES[ $this->attributes['etat'] ];
  }
  public function setEtatAttribute($value)
  {
    if(!isset($value))
      $this->attributes['etat'] = null;
    else
      $this->attributes['etat'] = (int) $value;
  }
  public function getEtatID() {
    return array_search($this->etat, self::STATES); 
  }
  public function getModeAdmissionAttribute()
  {
    return self::MODESADMISSION[ $this->attributes['modeAdmission'] ];
  }
  public static function getModeAdmissionID($mode) {
    return array_search($mode, self::MODESADMISSION); 
  }
  public function consultation()
  {
    return $this->belongsTo('App\modeles\consultation','id_consultation');
  }
  public function Service()
  {
    return $this->belongsTo('App\modeles\service','service'); 
  } 
  public function Specialite()
  {
    return $this->belongsTo('App\modeles\Specialite','specialite'); 
  }
  public function DemeandeColloque()
  {
    return $this->hasOne('App\modeles\dem_colloque','id_demande');
  }
  public function RDVs() 
  { 
    return $this->hasMany('App\modeles\rdv_hospitalisation','id_demande')->orderBy('date','desc')->first();
  }
  public function getInProgressMet()
  {
    return $this->hasOne('App\modeles\rdv_hospitalisation','id_demande')->whereNull('etat')->orderBy('date','desc')->first();
  }
  public function bedAffectation()
  {
    return $this->hasOne('App\modeles\bedAffectation','demande_id');
  }
}