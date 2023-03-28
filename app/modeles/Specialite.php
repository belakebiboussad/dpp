<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;
class Specialite extends Model
{
  public $timestamps = false;
	protected $fillable = ['nom','type','antecTypes','vaccins','appareils','nbMax','dhValid'];
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
  public function setAntecTypesAttribute($value)
  {
    $this->attributes['antecTypes'] = json_encode($value);
  }
 public function setAppareilsAttribute($value)
 {
    $this->attributes['appareils'] = json_encode($value);
 }
  public function setVaccinsAttribute($value)
  {
      $this->attributes['vaccins'] = json_encode($value);
  }
  public function employes ()
	{
		return $this->hasMany('App\modeles\employ','specialite')->orderBy('nom');
	}
}
