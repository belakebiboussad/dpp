<?php

namespace App\modeles;
use Illuminate\Database\Eloquent\Model;

class colloque extends Model
{
  public $timestamps = true;
  protected $fillable  = ['id','date','etat','service_id'];
  public const ETATS = [
    ''=> 'En cours',
    0 => 'Annulé',  
    1 => 'Cloturé'
  ];
  public function getEtatAttribute()
  {
    return self::ETATS[ $this->attributes['etat'] ];
  }
  public function getEtatID() {
    return array_search($this->etat, self::ETATS); 
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
