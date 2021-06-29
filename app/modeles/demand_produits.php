<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class demand_produits extends Model
{
	public $table ="demande_produits";
	public $timestamps = false;
      protected $fillable  = ['Date','etat','id_employe','motif'];
      public function medicaments()
      {
		return $this->belongsToMany('App\modeles\medcamte', 'demande_medicaments', 'id_demande', 'id_medicaments')->withPivot('qte','qteDonne');   	
      }
     public function dispositifs()
     {
		return $this->belongsToMany('App\modeles\dispositif', 'demande_dispositif', 'id_demande', 'id_dispositif')->withPivot('qte','qteDonne');   	
     }

    public function reactifs()
    {
		return $this->belongsToMany('App\modeles\reactif', 'demande_reactif', 'id_demande', 'id_reactif')->withPivot('qte','qteDonne');   	
    }
    public function demandeur()
    {
      return $this->belongsTo('App\modeles\employ', 'id_employe');
    }
}
