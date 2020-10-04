<?php
namespace App\modeles;
use Illuminate\Database\Eloquent\Model;
class DemandeHospitalisation extends Model
{
	protected $table = "demandehospitalisations";
 	public $timestamps = false;
 	protected $fillable = ['etat','service','specialite','modeAdmission','degree_urgence','id_consultation'];
  public function setEtatAttribute($value)
  {
    $this->attributes['etat'] = strtolower($value);
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
    return $this->hasMany('App\modeles\rdv_hospitalisation','id_demande')->orderBy('date_RDVh');
  }
  public function affectation()
  {
    return $this->hasOne('App\modeles\bedAffectation','demande_id');
  }
}
