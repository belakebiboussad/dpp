<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class assur extends Model
{
	public $timestamps = false;
	protected $primaryKey = 'NSS';
	public $incrementing = false;
	protected $fillable = ['Nom','Prenom','dob', 'pob','sf', 'Sexe','adresse','commune_res','wilaya_res','gs','NSS'];
	protected $appends = ['full_name']; //protected $dates =['dob'];
  protected $casts = [
    'dob' => 'date',
  ];
  public function getFullNameAttribute()
  {
    return $this->Nom." ".$this->Prenom ;
  }
  public function POB()
	{
    if(!(is_null($this->pob)))
		  return $this->belongsTo('App\modeles\Commune','pob');
	}
	public function commune()
	{
		if(!(is_null($this->commune_res)))
		  return $this->belongsTo('App\modeles\Commune','commune_res');
	}
	public function wilaya()
	{	
		if(isset($this->wilaya_res))
			return $this->belongsTo('App\modeles\Wilaya','wilaya_res');
	}
	public function patients()
	{
		return $this->hasMany('App\modeles\patient','assur_id');
	}
}
