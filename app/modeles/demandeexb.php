<?php

namespace App\modeles;
use Illuminate\Database\Eloquent\Model;
class demandeexb extends Model
{
  public $timestamps = false;
  protected $table = "demandeexb";
  protected $fillable = ['etat','resultat','imageable_id','imageable_type','crb'];
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
  public function examensbios()
  { 
return $this->belongsToMany('App\modeles\examenbiologique','demande_examenbio','demande_id','exam_id');
  }
  public function imageable()
  {
    return $this->morphTo();
  } 
  public function consultation()
  {
    return $this->belongsTo('App\modeles\consultation','imageable_id')
                ->where('demandeexb.imageable_type','App\modeles\consultation');
  }
  public function visite()
  {
    return $this->belongsTo('App\modeles\visite','imageable_id')
                ->where('demandeexb.imageable_type','App\modeles\visite');
  }
}