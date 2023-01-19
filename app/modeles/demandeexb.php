<?php

namespace App\modeles;
use Illuminate\Database\Eloquent\Model;
class demandeexb extends Model
{
  public $timestamps = false;
  protected $table = "demandeexb";
  protected $fillable = ['etat', 'resultat', 'id_consultation','visite_id','crb'];
  public const ETATS = [
    ''=> 'En Cours',
    0 => 'Rejetée',  
    1 => 'Validée'
  ];
  public function getEtatAttribute()
  {
    return self::ETATS[ $this->attributes['etat'] ];
  }
  public static function getEtatID($etat) {
    return array_search($etat, self::ETATS); 
  }
  public function examensbios()
  { 
    return $this->belongsToMany('App\modeles\examenbiologique','demande_examenbio','demande_id','exam_id');
  } 
  public function consultation()
  {
    return $this->belongsTo('App\modeles\consultation','id_consultation');
  }
  public function visite()
  {
    return $this->belongsTo('App\modeles\visite','visite_id');
  }
}