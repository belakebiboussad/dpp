<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class demandeexr extends Model
{
  public $timestamps = false;
  protected $table = "demandeexr";
  protected $fillable = ['InfosCliniques', 'Explecations', 'etat','id_consultation','visite_id'];
  public const ETATS = [
      ''=> 'En Cours',
      0 => 'Rejetée',  
      1 => 'Validée'
  ];
  public function getEtatAttribute()
  {
    return self::ETATS[ $this->attributes['etat'] ];
  }
  public function getEtatID() {
    return array_search($this->etat, self::ETATS); 
  }
  public function examensradios()
  { 
    return $this->hasMany('App\modeles\Demande_Examenradio','demande_id');
  }
  public function infossuppdemande()
  {
    return $this->belongsToMany('App\modeles\infosupppertinentes', 'demandeexradio_infosupppertinentes', 'id_demandeexr', 'id_infosupp');       
  }
  public function consultation()
  {
     return $this->belongsTo('App\modeles\consultation','id_consultation');
  }
  public function visite()
  {
    return $this->belongsTo('App\modeles\visite','visite_id');
  }
  public function hasCCR()
  {
   foreach($this->examensradios as $examen)
      {
        if(isset($examen->crr_id))
        {
          return true;       
        }
      }  
      return false;
  }
  public function hasResult()
  {
    foreach($this->examensradios as $examen)
    {
      if((isset($examen->crr_id)) || ($examen->getEtatID() != ""))
        return true;       
    }  
    return false;
  }
}