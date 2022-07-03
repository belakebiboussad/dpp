<?php

namespace App\modeles;
use Illuminate\Database\Eloquent\Model;

class colloque extends Model
{
  public $timestamps = true;
  protected $fillable  = ['id','date','etat','service_id'];//'type',
  public const ETATS = [
    ''=> 'En Cours',
    0 => 'Cloturé',  
    1 => 'Validé'
  ];
  public function getEtatAttribute()
  {
    return self::ETATS[ $this->attributes['etat'] ];
  }
  public static function getEtatID($etat) {
     return array_search($etat, self::ETATS); 
  }
  public function membres()
  {
      return $this->belongsToMany ('App\modeles\employ','membres','id_colloque','id_employ');
  }
   public function employs()
  {
      return $this->belongsToMany ('App\modeles\employ','membres','id_colloque','id_employ');
  }
  public function demandes()
  {
  	return $this->belongsToMany('App\modeles\DemandeHospitalisation','dem_colloques' ,'id_colloque','id_demande');
  }
  public function Service()
  {
    return $this->belongsTo('App\modeles\service','service_id');
  }
}
