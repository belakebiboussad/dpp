<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;
class Specialite extends Model
{
  public $timestamps = false;
	protected $fillable = ['nom','type','consConst','hospConst','exmsbio','exmsImg','antecTypes','vaccins','appareils'];
        public function setConsConstAttribute($value)
        {
              $this->attributes['consConst'] = json_encode($value);
        }
        public function setHospConstAttribute($value)
        {
              $this->attributes['hospConst'] = json_encode($value);
        }
        public function setExmsbioAttribute($value)
        {
               $this->attributes['exmsbio'] = json_encode($value);
        }/*public function getExmsbioAttribute($value){return $this->attributes['exmsbio'] = json_decode($value,true);}*/
        public function setExmsImgAttribute($value)
        {
         	$this->attributes['exmsImg'] = json_encode($value);
        }
       public function setAntecTypesAttribute($value)
       {
               $this->attributes['antecTypes'] = json_encode($value);
       }/*public function getAppareilsAttribute($value){return $this->attributes['appareils'] = json_decode($value,true);}*/
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
