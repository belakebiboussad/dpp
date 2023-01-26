<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class demand_produits extends Model
{
	public $table ="demande_produits";
	public $timestamps = false;
  protected $fillable  = ['date','etat','id_employe','motif'];
  protected $dates =['date'];
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
  public function medicaments()
  {
		return $this->belongsToMany('App\modeles\medcamte', 'demande_medicaments', 'id_demande', 'id_medicaments')->withPivot('qte','qteDonne','unite');   	
  }

  public function dispositifs()
  {
		return $this->belongsToMany('App\modeles\dispositif', 'demande_dispositif', 'id_demande', 'id_dispositif')->withPivot('qte','qteDonne','unite');   	
  }

  public function reactifs()
  {
		return $this->belongsToMany('App\modeles\reactif', 'demande_reactif', 'id_demande', 'id_reactif')->withPivot('qte','qteDonne','unite');   	
  }
  public function consomables()
  {
		return $this->belongsToMany('App\modeles\Consommable', 'demande_consomable', 'id_demande', 'id_consomable')->withPivot('qte','qteDonne','unite');   	
  }

  public function demandeur()
  {
    return $this->belongsTo('App\modeles\employ', 'id_employe');
  }

}
