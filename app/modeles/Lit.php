<?php

namespace App\modeles;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Lit extends Model
{ //etat si etat=0  il est bloque,etat= 1 non bloque, //affectation , affectation = 0 libre,affectation = 1 occupé    
  //bloqué si bloq=1  il est bloque,bloq= null non bloque, //affectation , affectation = null libre,affectation = 1 occupé    
  public $timestamps = false;
  protected $fillable = ['num','nom','bloq','affectation','salle_id'];
  public function salle() {
	       return $this->belongsTo('App\modeles\salle','salle_id');
  }
  protected $casts = [
    'affectation' => 'boolean',
    'bloq' => 'boolean',
  ];
  public function bedReservation()
  { 
    return $this->hasMany('App\modeles\BedReservation','id_lit');
  }
  public function getReservation($start, $end)
  { 
    $resrvs = [];
    $now = $today = Carbon::now()->toDateString();
    $reservations =  $this->bedReservation()->whereHas('rdvHosp',function($q) use($now){ 
                                      $q->where('date','>=', $now);
                                    })->get(); 
   
    foreach ($reservations as $res) {
      if(((strtotime($res->rdvHosp->date_Prevu_Sortie) > $start) && (strtotime($res->rdvHosp->date_Prevu_Sortie) <= $end)) || ((strtotime($res->rdvHosp->date) >= 
      $start) && (strtotime($res->rdvHosp->date) < $end)) || ((strtotime($res->rdvHosp->date) >= $start) && (strtotime($res->rdvHosp->date_Prevu_Sortie) <= $end))
      ||((strtotime($res->rdvHosp->date)  < $start ) && (strtotime($res->rdvHosp->date_Prevu_Sortie) > $end)))
      array_push($resrvs, $res);
    }
    return $resrvs;   
  }
  // begin
  // public function isFree($start , $end)//libre de reservations
  // {
  //   $now = Carbon::now()->setTime(0, 0, 0);
  //   return $now;
  // }
  // end
  public function isFree($start , $end)//libre de reservations
  {
    $now = Carbon::now()->setTime(0, 0, 0);//$now = \Carbon\Carbon::now();
    $idlit = $this->id;  /*$lit =Lit::FindOrFail($idlit);if($lit->bloq == 1)return false;*/
    if(isset($this->bloq))
      return false; 
    // je cherche les reservaaion future//not testé   
    $reservations =  bedReservation::whereHas('lit',function($q) use($idlit){
                                            $q->where('id',$idlit);
                                    })->whereHas('rdvHosp',function($q) use($now){
                                        $q->where('date','>=', $now);
                                    })->get(); /*$reservations = $this->bedReservation()->whereHas('rdvHosp',function($q) use($now){ $q->where('date','>=', $now); })->get(); */                                                 
    foreach ($reservations as $res) {/* if(( $start < strtotime($res->rdvHosp->date_Prevu_Sortie)) && ($end > strtotime($res->rdvHosp->date)))return false; */  
    if(((strtotime($res->rdvHosp->date_Prevu_Sortie) > $start) && (strtotime($res->rdvHosp->date_Prevu_Sortie) <= $end))|| ((strtotime($res->rdvHosp->date) >= 
    $start) && (strtotime($res->rdvHosp->date) < $end)) || ((strtotime($res->rdvHosp->date) >= $start) && (strtotime($res->rdvHosp->date_Prevu_Sortie) <= $end))
    ||((strtotime($res->rdvHosp->date)  < $start ) && (strtotime($res->rdvHosp->date_Prevu_Sortie) > $end)))
        return false;   
    }   
    return true;
  }//dans le cas hosp urg le lit qui a une reserv a partir d'aujourd'hui
/*public function isFreeU($start){$lit =Lit::FindOrFail($this->id);if($lit->etat == 0)return false;$reservations =  bedReservation::whereHas('lit',function($q) use($idlit){ //toute les reservation du lit
$q->where('id',$idlit);})->get();foreach ($reservations as $key => $reservation){if( $start <= strtotime($reservation->rdvHosp->date_Prevu_Sortie))return true;} return false;}*/
  public function isAffected($id)
  {
    $affect = false;
    $lit =Lit::FindOrFail($id);
    if($lit->bloq == 1 || $lit->affectation == 1 )
      $affect = true; 
    return $affect;
  } 
}
