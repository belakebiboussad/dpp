<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class demandeexr extends Model
{
  public $timestamps = false;
  protected $table = "demandeexr";
  protected $fillable = ['InfosCliniques', 'Explecations', 'etat','id_consultation','visite_id'];//'resultat', 
  protected $appends = ['infos'];
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
  public function examensradios()
  { 
    //return $this->hasMany('App\modeles\Demandeexr_Examenradio','demande_id');    
    return $this->belongsToMany('App\modeles\examenradiologique','demandeexr_examenradio','demande_id','exm_id')->withPivot('type_id','resultat','etat','observation','crr_id');    
  }
  /*public function typeExam(){ return $this->belongsToMany('App\modeles\TypeExam', 'examradio_typeExam', 'id_demandeexradio', 'id_typexam');       
  }*/
  public function infossuppdemande()
  {
    return $this->belongsToMany('App\modeles\infosupppertinentes', 'demandeexradio_infosupppertinentes', 'id_demandeexr', 'id_infosupp');       
  }
  public function getInfosAttribute()
  {
    return $this->infossuppdemande->pluck('id')->toArray();
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
      if((isset($examen->crr_id)) || ($examen->getEtatID($examen->etat) != ""))
      {
        return true;       
      }
    }  
    return false;
  }
}
