<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;
class rdv extends Model
{
  public const STATES = [
    ''=> 'En cours',
    0 => 'Annule',
    1 => 'valide',
  ];
 	public $timestamps = false;
	protected $fillable =['date','fin','fixe','patient_id','employ_id','specialite_id','etat'];
	protected $dates = ['date', 'fin'];
	protected $appends = ['start'];
  public function getStartAttribute()
  {
    return $this->date->format('Y-m-d');
  }
  public function getEndAttribute()
  {
    return $this->attributes['fin'];
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
	}
	public function patient()
	{
		return $this->belongsTo('App\modeles\Patient','patient_id');
	}
	public function employe()
	{
		return $this->belongsTo('App\modeles\employ','employ_id');
	}
	public function specialite()
	{
		return $this->belongsTo('App\modeles\Specialite','specialite_id');
	}
}
