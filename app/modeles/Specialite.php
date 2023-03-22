<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;
class Specialite extends Model
{
  public $timestamps = false;
  // 'exmsbio',
	protected $fillable = ['nom','type','consConst','hospConst','exmsImg','antecTypes','vaccins','appareils','nbMax','dhValid'];
  public function setConsConstAttribute($value)
  {
    $this->attributes['consConst'] = json_encode($value);
  }
  public function setHospConstAttribute($value)
  {
    $this->attributes['hospConst'] = json_encode($value);
  }
/*public function setExmsbioAttribute($value){$this->attributes['exmsbio'] = json_encode($value); }*/
  public function BioExams()
  {
return $this->belongsToMany('App\modeles\examenbiologique','examenbio_specialite','spec_id','examen_id');
  }
  public function setExmsImgAttribute($value)
  {
   	$this->attributes['exmsImg'] = json_encode($value);
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
