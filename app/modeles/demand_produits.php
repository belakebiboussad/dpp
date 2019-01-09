<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class demand_produits extends Model
{
	public $table ="demande_produits";
	public $timestamps = false;
    protected $fillable  = ['Date','Etat', 'motif' , 'id_employe'];

    public function medicaments()
    {
		return $this->belongsToMany('App\modeles\medcamte', 'demande_medicaments', 'id_demande', 'id_medicaments')->withPivot('qte');   	
    }

    public function dispositifs()
    {
		return $this->belongsToMany('App\modeles\dispositif', 'demande_dispositif', 'id_demande', 'id_dispositif')->withPivot('qte');   	
    }

    public function reactifs()
    {
		return $this->belongsToMany('App\modeles\reactif', 'demande_reactif', 'id_demande', 'id_reactif')->withPivot('qte');   	
    }

    public function demandeur()
    {
        return $this->belongsTo('App\modeles\employ', 'id_employe');
    }
}
