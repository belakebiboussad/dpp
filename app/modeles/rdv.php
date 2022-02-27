<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;
// use MaddHatter\LaravelFullcalendar\Event;// use MaddHatter\LaravelFullcalendar\IdentifiableEvent;//use Calendar;
class rdv extends Model// implements IdentifiableEvent
{
	public $timestamps = false;
	protected $fillable =['date','fin','fixe','patient_id','employ_id','specialite_id','etat'];
	protected $dates = ['date', 'fin'];//,'Temp_rdv'
	public function getId() {
		return $this->id;
	}/*public function getTitle(){return $this->patient_id;}*/
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
