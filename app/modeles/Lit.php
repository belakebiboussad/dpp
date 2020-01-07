<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class Lit extends Model
{
    //etat si il est bloque,etat= 1 non bloque, etat=0  bloqué
    //affectation , affectation = 0 libre,affectation = 1 occupé 		
    public $timestamps = false;
    protected $fillable = ['num','nom','etat','affectation','salle_id'];
    public function salle() {
    	return $this->belongsTo('App\modeles\salle','salle_id');
    }
    public function isFree($idlit, $start , $end)
    {
 			  $reservations  =  bedReservation::whereHas('lit',function($q) use($idlit){
 														 	  $q->where('id',$idlit)->where('etat',1);
 			 					 				})
 			  								->whereHas('rdvHosp',function ($q)use($start,$end){
 			  										$q->where('date_RDVh','<=',$end)->where('date_Prevu_Sortie','>',$start); 
 			  								})->get(); 	
 			  if($reservations->count() >0 )
 			  	return false;
 			  else
 			  	return true;

    }
}
