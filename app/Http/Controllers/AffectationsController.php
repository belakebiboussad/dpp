<?php

namespace App\Http\Controllers;
use App\modeles\service;
use App\modeles\rdv_hospitalisation;
use App\modeles\DemandeHospitalisation;
use App\modeles\lit;
use App\modeles\bedAffectation;
use Illuminate\Http\Request;
use Auth; 
use Carbon\Carbon;
use Response;
class AffectationsController extends Controller
{
  public function index()
  {
    $affects = bedAffectation::all();
    return view('bedAffectations.index',compact('affects'));
  }
  public function create()
  {
    $now = date("Y-m-d", strtotime('now'));
    $services = service::where('hebergement','1')->get();
    $rdvs = rdv_hospitalisation::doesntHave('demandeHospitalisation.bedAffectation')
                                ->whereHas('demandeHospitalisation',function ($q){
                                     $q->where('service',Auth::user()->employ->service_id)->where('etat',1);      
                              })->where('date','>=',$now)->where('etat', null)->get();                         
    $demandesUrg= DemandeHospitalisation::doesntHave('bedAffectation')
                                  ->whereHas('consultation',function($q) use($now){
                                       $q->where('date', $now);
                                  })->where('modeAdmission','2')->where('etat',null)->where('service',Auth::user()->employ->service_id)->get();
    return view('bedAffectations.create', compact('rdvs','demandesUrg','services'));  
  }
  public function store(Request $request)
  {
    $free = true;
    $demande= DemandeHospitalisation::find($request->demande_id); 
    $lit = lit::FindOrFail( $request->lit_id);
    return $lit->bedReservation; 
    if($demande->getModeAdmissionID($demande->modeAdmission) !=2) 
    { 
      $rdv = $demande->getInProgressMet(); 
      if($rdv->bedReservation()->exists()) 
      {
        if($rdv->bedReservation->id_lit != $request->lit_id)  //lit est-il reservé entre ces dattes ?
          $free = $lit->isFree(strtotime($rdv->date),strtotime($rdv->date_Prevu_Sortie)); 
        $rdv->bedReservation()->delete();
      }else    
        $free = $lit->isFree(strtotime($rdv->date),strtotime($rdv->date_Prevu_Sortie)); 
    }else
    { 
      $now = $today = Carbon::now()->toDateString();
      $newDateTime = Carbon::now()->addDay(3)->toDateString();
      $free = $lit->isFree(strtotime($now),strtotime( $newDateTime));
    } 
    //on doit supprimer cet reservation de lit selectioner entre ces dattes
    if(!$free)
    {
      $lit->bedReservation()->delete();// return Response::json($free);
      return $lit;
    }else
      return  $lit;
    
  }
  //affeter lit pour demande d'urgence
  public function affecterLit(Request $request )
  {
    $demande= DemandeHospitalisation::find($request->demande_id); 
    $lit = lit::FindOrFail( $request->lit_id);
    if($demande->getModeAdmissionID($demande->modeAdmission) !=2) 
    { 
      $rdv = $demande->getInProgressMet();   
      if($rdv->has('bedReservation'))
        $rdv->bedReservation()->delete();
        //$free = $lit->isFree(strtotime($rdv->date),strtotime($rdv->date_Prevu_Sortie));  
    }else
    { 
      $now = $today = Carbon::now()->toDateString();
      $newDateTime = Carbon::now()->addDay(3)->toDateString();
      //get reservation of this bed between this day
      $free = $lit->isFree(strtotime($now),strtotime( $newDateTime));
      $demande->update([ 'etat' => 1 ]); //program  
    }
    /*
    if(!$free)
      $lit->bedReservation()->delete(); 
    */
    $affect = bedAffectation::create($request->all());
    $lit->update([ "affectation" =>1 ]);
    return $affect;
  }

  public function destroy($demande_id)
  {
    $affect = bedAffectation::where('demande_id',$demande_id);
    $affect->delete();
    return redirect()->action('AffectationsController@index');
  }
}
