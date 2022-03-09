<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;
use Arr;
use Carbon\Carbon;
class homme_conf extends Model
{
  public const LIENS = [
    0 => 'Conjoint(e)',
    1 => 'Père',
    2 => 'Mère',
    3 => 'Frère',
    4  => 'Soeur',
    5 => 'Ascendant',
    6 => 'Descendant',
    7 => 'Membre de la famille',
    8  => 'Ami',
    9  => 'Collègue',
    10  => 'Employeur',
    11  => 'Employé',
    12  => 'Tuteur',
    13  => 'Autre',
  ];
	protected $fillable  = ['id','id_patient','nom','prenom','date_naiss','type','lien_par','type_piece','num_piece','date_deliv','adresse','mob','etat_hc','created_by','updated_by','updated_at'];
	protected $appends = ['full_name','age'];
  public function getFullNameAttribute()
  {
    return $this->nom." ".$this->prenom ;
  }
  public function patient()
	{
		return $this->belongsTo('App\modeles\patient','id_patient');
	}
  public function getAgeAttribute()  {
    return (Carbon::createFromDate(date('Y', strtotime($this->date_naiss)), date('m', strtotime($this->date_naiss)), date('d', strtotime($this->date_naiss)))->age);
  }
  public function getLienPAttribute()
  {
    return self::LIENS[ $this->attributes['lien_par'] ];
  }	
 }
