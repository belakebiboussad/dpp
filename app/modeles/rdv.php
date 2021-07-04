<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;
// use MaddHatter\LaravelFullcalendar\Event;// use MaddHatter\LaravelFullcalendar\IdentifiableEvent;//use Calendar;
class rdv extends Model// implements IdentifiableEvent
{
	public $timestamps = false;//Patient_ID_Patient
	protected $fillable =['Date_RDV','Fin_RDV','fixe','patient_id','Employe_ID_Employe','specialite_id','Etat_RDV'];
	protected $dates = ['Date_RDV', 'Fin_RDV'];//,'Temp_rdv'
	public function getId() {
		return $this->id;
	}/*public function getTitle(){return $this->patient_id;}*/
	public function isAllDay()
	 {
	  	return (bool)$this->all_day;
	 }
	 public function getStart()
	{
		  return $this->Date_RDV;
	}
	public function getEnd()
	{
	       return $this->Date_RDV;
	}/*public function getTime(){      return $this->Temp_rdv;}*/
	public function patient()
	{
		return $this->belongsTo('App\modeles\Patient','patient_id','id');
	}// public function getAsDate(){$date =date('Y-m-d h:i:s A', strtotime($this->Date_RDV. '+12 hours'));	return $date;	}
	public function employe()
	{
		return $this->belongsTo('App\modeles\employ','Employe_ID_Employe');
	}
	public function specialite()
	{
		return $this->belongsTo('App\modeles\Specialite','specialite_id');
	}
}
