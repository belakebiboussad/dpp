<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class hospitalisation extends Model
{
  public $timestamps = false;
  protected $fillable  = ['id','date','Date_Prevu_Sortie','Date_Sortie','patient_id','id_admission','HeurEnt', 'Heure_Prevu_Sortie', 'Heure_sortie', 'etat','modeHosp_id','medecin_id','garde_id','resumeSortie','etatSortie','modeSortie','diagSortie','ccimdiagSortie'];
    //modeSorie =[''=>Dom, '0'=>Trans, '1'=>,Contreaviméd, '2'=>Déc,'3'=>Repor]
    protected $dates =['date','Date_Prevu_Sortie','Date_Sortie'];
    protected $appends = ['nb_days'];
    public const STATES = [''=> 'En cours', 1 => 'cloturée'];
    public function getHeurSorFormattedAttribute()
    {
      return \Carbon\Carbon::parse($this->Heure_sortie)->format('H:i');
    }
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
    public function getEtatID()
    {
      return array_search($this->etat, self::STATES); 
    }
    public function getNbDaysAttribute()
    {
      if(!isset($this->Date_Sortie))
        $this->Date_Sortie = \Carbon\Carbon::now();
      return (Carbon::parse($this->Date_Sortie)->diffInDays($this->date));  
    }
    public function admission()
    {
     	return $this->belongsTo('App\modeles\admission','id_admission');
    }
    public function visites()
    {
      return$this->hasMany('App\modeles\visite','id_hosp')->orderBy('date', 'DESC')->orderBy('heure','DESC');
    }
    public function garde()
    {
      return $this->belongsTo('App\modeles\homme_conf','garde_id');
    }
    public function patient()
    {
        return $this->belongsTo('App\modeles\patient','patient_id');
    }
       public function modeHospi()
      {
            return $this->belongsTo('App\modeles\ModeHospitalisation','modeHosp_id');
       }
    public function medecin()
    {
      return $this->belongsTo('App\modeles\employ','medecin_id');
    }
    public function getlastVisiteWitCsts()
    { 
      return visite::has('Constantes')->where('id_hosp',$this->id)->orderBy('date','DESC')->orderBy('heure','DESC')->first();
    }
    public function Transfert()
    {
      return $this->hasOne('App\modeles\Transfert','hosp_id');
    }
     public function Dece()
    {
      return $this->hasOne('App\modeles\Dece','hosp_id');
    }
}
