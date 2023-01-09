<?php

namespace App\modeles;
use Illuminate\Database\Eloquent\Model;
class service extends Model
{
	public $timestamps = false;
	protected $fillable = ['nom','type','specialite_id','responsable_id','hebergement','urgence'];
        public const TYPE = [
          0 => 'Médical',
          1 => 'Chirurgical',
          2 => 'Paramédical',
          3 => 'Administratif',
        ];
  public function getTypeAttribute()
 {
        return self::TYPE[ $this->attributes['type'] ];
  }
	public function responsable()
	{   
	  return $this->belongsTo('App\modeles\employ','responsable_id');
	}
  public function employs()
	{
    return $this->hasMany('App\modeles\employ');
	}
  public function Medecins()
  {
    return $this->hasMany('App\modeles\employ')->whereHas('User',function($q){
                  $q->whereIn('role_id',[1,13,14]);
             });
  }
  public function Specialite()
  {
    return $this->belongsTo('App\modeles\Specialite','specialite_id');
  }
	public function salles()
	{
    return $this->hasMany('App\modeles\salle');    		
	}
}

