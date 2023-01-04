<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;
class rdv extends Model// implements IdentifiableEvent
{
  public const STATES = [
    ''=> 'en Cours',
    0 => 'Annule',
    1 => 'valide',
  ];
	public $timestamps = false;
	protected $fillable =['date','fin','fixe','patient_id','employ_id','specialite_id','etat'];
	protected $dates = ['date', 'fin'];//,'Temp_rdv'
	protected $appends = ['title'];
  public function getStartAttribute()
  {
    return $this->attributes['date'];
  }
  public function getEndAttribute()
  {
    return $this->attributes['fin'];
  }
  public function getTitleAttribute()
  {
    return $this->patient->attributes['Nom'].' '.$this->patient->attributes['Prenom'];
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
  public static function getEtatID($state) {
    return array_search($state, self::STATES); 
  }
  public function isAllDay()
	{
	 	return (bool)$this->all_day;
	}
	 public function getStart()
	{
		 return $this->date;
	}
	public function getEnd()
	{
	  return $this->date;
	}/*public function getTime(){      return $this->Temp_rdv;}*/
	public function patient()
	{
		return $this->belongsTo('App\modeles\Patient','patient_id','id');
	}// public function getAsDate(){$date =date('Y-m-d h:i:s A', strtotime($this->date. '+12 hours'));	return $date;	}
	public function employe()
	{
		return $this->belongsTo('App\modeles\employ','employ_id');
	}
	public function specialite()
	{
		return $this->belongsTo('App\modeles\Specialite','specialite_id');
	}
}
