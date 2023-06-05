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
    $now =  Carbon::today()->format('Y-m-d');
    $services = service::where('hebergement','1')->get();
    $rdvs = rdv_hospitalisation::doesntHave('demandeHospitalisation.bedAffectation')
                                ->whereHas('demandeHospitalisation',function ($q){
                                     $q->where('service',Auth::user()->employ->service_id)->where('etat',1);      
                              })->where('date','>=',$now)->whereNull('etat')->get();                         
    $demandesUrg= DemandeHospitalisation::doesntHave('bedAffectation')
                                  ->whereHas('consultation',function($q) use($now){
                                       $q->where('date', $now);
                                  })->where('modeAdmission','2')->whereNull('etat')->where('service',Auth::user()->employ->service_id)->get();
    return view('bedAffectations.create', compact('rdvs','demandesUrg','services'));  
  }
  public function store(Request $request)
  {
    $free = true;
    $demande= DemandeHospitalisation::find($request->demande_id); 
    $lit = lit::FindOrFail( $request->lit_id);
    /*teste */
    /*end teste*/
    if($demande->getModeAdmissionID($demande->modeAdmission) !=2) //non urgente
    { 
      $rdv = $demande->getInProgressMet(); 
      if($rdv->bedReservation()->exists())
        $rdv->bedReservation()->delete();         
      $free = $lit->isFree(strtotime($rdv->date),strtotime($rdv->date_Prevu_Sortie));
      if(!$free)
      {
        $reservs = $lit->getReservation(strtotime($rdv->date), strtotime($rdv->date_Prevu_Sortie));
        foreach ($reservs as $res) {
          $res->delete();
        }
      }  
    }else
    { 
      $now = $today = Carbon::now()->toDateString();
      $newDateTime = Carbon::now()->addDay(2)->toDateString();
      $free = $lit->isFree(strtotime($now),strtotime( $newDateTime));
      if(!$free)
      {
        $reservs = $lit->getReservation(strtotime($now), strtotime($newDateTime));
        foreach ($reservs as $res) { 
          $res->delete();
        }
      }  
      $demande->update([ 'etat' => 1 ]); //program  
    } 
    $affect = bedAffectation::create($request->all());
    $lit->update([ "affectation" =>1 ]);
    return $affect;
  } 
  public function destroy($id)
  {     //$affect = bedAffectation::with('demandeHosp','Lit')->where('demande_id',$demande_id)->firstOrFail(); 
    $affect = bedAffectation::with('demandeHosp','Lit')->find($id); 
    if($affect->demandeHosp->getModeAdmissionID($affect->demandeHosp->modeAdmission)== 2)
               $affect->demandeHosp->update([ 'etat'=>null]);
    $affect->Lit->update(['affectation'=>null]);
    $affect->delete();
    return redirect()->action('AffectationsController@index');
  }
}