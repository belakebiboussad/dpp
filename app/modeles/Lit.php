<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class Lit extends Model
{
  //etat si etat=0  il est bloque,etat= 1 non bloque, //affectation , affectation = 0 libre,affectation = 1 occupé    
  public $timestamps = false;
   protected $fillable = ['num','nom','etat','affectation','salle_id'];
  public function salle() {
	       return $this->belongsTo('App\modeles\salle','salle_id');
  }
  public function isFree($start , $end)
  {
    $free = true;
    $idlit = $this->id;
    $lit =Lit::FindOrFail($idlit);
    if($lit->etat == 0)
      return false; 
    $reservations =  bedReservation::whereHas('lit',function($q) use($idlit){
                                              $q->where('id',$idlit);
                                    })->get();   
    foreach ($reservations as $key => $reservation) {
      if(( $start < strtotime($reservation->rdvHosp->date_Prevu_Sortie)) && ($end > strtotime($reservation->rdvHosp->date_RDVh)))
        $free = false;
    }   
    return $free;
  }
  public function isFree()
  {
    $lit =Lit::FindOrFail($idlit);
    if($lit->etat == 0 || $lit->affectation == 1 )
      return false; 
  } 

}
