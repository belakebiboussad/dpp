<?php

namespace App\Http\Controllers;
use App\modeles\service;
use App\modeles\rdv_hospitalisation;
use App\modeles\DemandeHospitalisation;
use Illuminate\Http\Request;
use Auth; 

class AffectationsController extends Controller
{
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
}
