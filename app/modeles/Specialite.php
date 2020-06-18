<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class Specialite extends Model
{
	 //
	public $timestamps = false;
	protected $fillable = ['nom','type'];
	public function type()
	{
		return $this->belongsTo('App\modeles\Type_specialite','type');
	}
	public function employes ()
	{
		return $this->hasMany('App\modeles\employ','Specialite_Emploiye');
	}

}
