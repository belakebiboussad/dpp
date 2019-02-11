<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;
use MaddHatter\LaravelFullcalendar\Event;
use Calendar;
class rdv extends Model implements Event
{
	public $timestamps = false;
	protected $fillable =['Date_RDV','Temp_rdv','specialite', 'Patient_ID_Patient','Employe_ID_Employe','Etat_RDV'];
	protected $dates = ['Date_RDV', 'Temp_rdv'];
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
	}

}
