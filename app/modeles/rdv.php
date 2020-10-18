<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;
// use MaddHatter\LaravelFullcalendar\Event;
use MaddHatter\LaravelFullcalendar\IdentifiableEvent;
use Calendar;
class rdv extends Model implements IdentifiableEvent
{
	public $timestamps = false;
	protected $fillable =['Date_RDV','Fin_RDV','fixe','specialite', 'Patient_ID_Patient','Employe_ID_Employe','Etat_RDV'];
	protected $dates = ['Date_RDV', 'Fin_RDV'];//,'Temp_rdv'
	public function getId() {
		return $this->id;
	}
	public function getTitle()
 	{
  	return $this->Patient_ID_Patient;
  }
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
		return $this->belongsTo('App\modeles\Patient','Patient_ID_Patient','id');
	}
	public function getAsDate()
	{
		$date =date('Y-m-d h:i:s A', strtotime($this->Date_RDV. '+12 hours')); 
		return $date;
	}

	public function employe()
	{
			return $this->belongsTo('App\modeles\employ','Employe_ID_Employe','id');
	}
	public function Specilite()
	{
		return $this->belongsTo('App\modeles\Specialite','specialite','id');
	}
}
