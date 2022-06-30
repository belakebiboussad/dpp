<?php

namespace App\modeles;
use Illuminate\Database\Eloquent\Model;
class Lit extends Model
{ //etat si etat=0  il est bloque,etat= 1 non bloque, //affectation , affectation = 0 libre,affectation = 1 occupé    
  public $timestamps = false;
  protected $fillable = ['num','nom','etat','affectation','salle_id'];
  public function salle() {
	       return $this->belongsTo('App\modeles\salle','salle_id');
  }
  protected $casts = [
          'affectation' => 'boolean',
          'etat' => 'boolean',
  ];
   public function bedReservation()
  {
        return $this->hasOne('App\modeles\BedReservation','id_lit');//hasOne
  }
       public function isFree($start , $end)//libre de reservation
       {
            $idlit = $this->id;
            $lit =Lit::FindOrFail($idlit);
            if($lit->etat == 0)
                return false; 
             $reservations =  bedReservation::whereHas('lit',function($q) use($idlit){ 
                                                                          $q->where('id',$idlit);
                                                                      })->get(); 
              foreach ($reservations as $key => $reservation) {
               if(( $start < strtotime($reservation->rdvHosp->date_Prevu_Sortie)) && ($end > strtotime($reservation->rdvHosp->date)))
                         return false;
                }   
              return true;
  }//dans le cas hosp urg le lit qui a une reserv a partir d'aujourd'hui
/*public function isFreeU($start){$lit =Lit::FindOrFail($this->id);if($lit->etat == 0)return false;$reservations =  bedReservation::whereHas('lit',function($q) use($idlit){ //toute les reservation du lit
$q->where('id',$idlit);})->get();foreach ($reservations as $key => $reservation){if( $start <= strtotime($reservation->rdvHosp->date_Prevu_Sortie))return true;} return false;}*/
  public function affecter($id)
  {
    $affect = false;
    $lit =Lit::FindOrFail($id);
    if($lit->etat == 0 || $lit->affectation == 1 )
      $affect = true; 
    return $affect;
  } 
}
