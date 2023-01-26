<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class Demande_Examenradio extends Model
{
  public $timestamps = false;
  protected $table = "demande_examenradio";
  protected $fillable = ['demande_id','exm_id','type_id','resultat','etat','observation','crr_id'];
  public const ETATS = [
    ''=> 'En Cours',
    0 => 'Rejeté',  
    1 => 'Validé'
  ];
  public function getEtatAttribute()
  {
    return self::ETATS[ $this->attributes['etat'] ];
  }
  public function getEtatID() {
    return array_search($this->etat, self::ETATS); 
  }
  public function Demande()
  {
    return $this->belongsTo('App\modeles\demandeexr','demande_id');
  }
  public function Examen()
  {
    return $this->belongsTo('App\modeles\examenradiologique','exm_id');
  }
  public function Type()
  {
    return $this->belongsTo('App\modeles\TypeExam','type_id');
  }
  public function Crr()
  {
    return $this->belongsTo('App\modeles\CRR','crr_id');
  }
}
