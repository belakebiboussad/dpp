<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;
use Arr;
use Carbon\Carbon;
class homme_conf extends Model
{
	 protected $fillable  = ['id','id_patient','nom','prenom','date_naiss','type','lien_par','type_piece','num_piece','date_deliv','adresse','mob','etat_hc','created_by','updated_by','updated_at'];
	protected $appends = ['full_name'];
        public function getFullNameAttribute()
        {
                return $this->nom." ".$this->prenom ;
        }
        public function patient()
	{
	  	return $this->belongsTo('App\modeles\patient','id_patient');
	 }
	 public function getAge(){	
		return (Carbon::createFromDate(date('Y', strtotime($this->date_naiss)), date('m', strtotime($this->date_naiss)), date('d', strtotime($this->date_naiss)))->age);
		}	
 }
