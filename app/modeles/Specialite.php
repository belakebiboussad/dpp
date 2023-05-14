<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;
class Specialite extends Model
{
  public $timestamps = false;
	protected $fillable = ['nom', 'type' , 'vaccins', 'nbMax','dhValid'];
  public function Consts()
  {
    return $this->belongsToMany('App\modeles\Constante','constante_specialite','spec_id','const_id');
  }
  public function BioExams()
  {
    return $this->belongsToMany('App\modeles\examenbiologique','examenbio_specialite','spec_id','examen_id');
  }
  public function ImgExams()
  {
    return $this->belongsToMany('App\modeles\TypeExam','examenimg_specialite','spec_id','examen_id');
  }
  public function appareils()
  {
    return $this->belongsToMany('App\modeles\Appareil','appareil_specialite','spec_id','appareil_id');
  }
  public function antecTypes()
  {
    return $this->belongsToMany('App\modeles\antecType','antecedant_specialite','spec_id','type_id');
  }
  public function setVaccinsAttribute($value)
  {
      $this->attributes['vaccins'] = json_encode($value);
  }
  public function employes ()
	{
		return $this->hasMany('App\modeles\employ','specialite')->orderBy('nom');
	}
  public function Parameters(){
    return $this->hasMany('App\modeles\param_specialite','spec_id');
  }
}