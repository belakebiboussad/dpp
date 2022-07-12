<?php

namespace App\modeles;
use Illuminate\Database\Eloquent\Model;
class service extends Model
{
	public $timestamps = false;
	protected $fillable = ['nom','type','specialite_id','responsable_id','hebergement','urgence'];
	public function responsable()
	{   
	  return $this->belongsTo('App\modeles\employ','responsable_id');
	}
  public function employs()
	{
    return $this->hasMany('App\modeles\employ');
	}
  public function Specialite()
  {
    return $this->belongsTo('App\modeles\Specialite','specialite_id');
  }
	public function salles()
	{
    return $this->hasMany('App\modeles\salle');    		
	}/*public function Type(){  return $this->belongsTo('App\modeles\typeService','type'); }*/ 
}

