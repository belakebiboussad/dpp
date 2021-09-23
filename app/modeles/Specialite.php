<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class Specialite extends Model
{
	public $timestamps = false;
	protected $fillable = ['nom','type','exmsbio','exmsImg'];	/*public function type(){return $this->belongsTo('App\modeles\Type_specialite','type');}*/
	public function setExmsbioAttribute($value)
  {
    $this->attributes['exmsbio'] = json_encode($value);
  }
  /*public function getExmsbioAttribute($value)	{
    return $this->attributes['exmsbio'] = json_decode($value,true);
  }*/
  public function setExmsImgAttribute($value)
  {
   	$this->attributes['exmsImg'] = json_encode($value);
  }
  /*public function getExmsImgAttribute($value) {
     return $this->attributes['exmsImg'] = json_decode($value,true);  	
  }*/
	public function employes ()
	{
		return $this->hasMany('App\modeles\employ','specialite')->orderBy('nom');
	}
}
