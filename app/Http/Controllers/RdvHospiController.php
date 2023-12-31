<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\modeles\dem_colloque;
use App\modeles\service;
use App\modeles\rdv_hospitalisation;
use App\modeles\BedReservation;
use App\modeles\employ;
use App\modeles\DemandeHospitalisation;
use App\modeles\salle;
use App\modeles\Lit;
use App\modeles\Etablissement;
use Auth;
use Carbon\Carbon;
use PDF;
use Response;
class RdvHospiController extends Controller
{
 public function __construct()
  {
      $this->middleware('auth');
  }
  public function index(Request $request)
  {
    if($request->ajax())
    {
      $rdvs = ""; 
      switch($request->field)
      {
        case "date":
            $rdvs =rdv_hospitalisation::with('demandeHospitalisation.consultation.patient','demandeHospitalisation.Service','demandeHospitalisation.bedAffectation.lit.salle.service')
                                    ->whereHas('demandeHospitalisation', function($q){
                                            $q->where('etat', 1);
                                    })->where(trim($request->field),trim($request->value))->get();
             break;
        case "IPP":
              $ipp = $request->value; 
              $rdvs =rdv_hospitalisation::with('demandeHospitalisation.consultation.patient','demandeHospitalisation.Service','demandeHospitalisation.bedAffectation.lit.salle.service')
                                    ->whereHas('demandeHospitalisation', function($q){
                                          $q->where('etat', 1);
                                    })->whereHas('demandeHospitalisation.consultation.patient',function($q)use($ipp){
                                             $q->where('IPP', $ipp);
                                    })->where('date',Carbon::today())->get();
          break;  
        default:
          break;       
      }  
      return $rdvs;
    }else
    {
      $services = service::where('type','<>',2)->where('hebergement','1')->get();
      $specialite = Auth::user()->employ->Service->Specialite;//tester si il y'à validation demandes etat 5 sinon etat 0 
      $state = ($specialite->dhValid) ? 5: null;
      $demandes =DemandeHospitalisation::with('DemeandeColloque')->where('modeAdmission','<>',2)->where('etat',$state)->where('service',Auth::user()->employ->service_id)->get();
        return view('rdvHospi.index', compact('specialite','demandes','services'));
    }
  }
  public function store(Request $request)
  {
    $rdv = rdv_hospitalisation::firstOrCreate([
        "date"         =>$request->dateEntree,
        "heure"        =>$request->heure,   
        "id_demande"        =>$request->demande_id,       
        "date_Prevu_Sortie" =>$request->dateSortiePre,
        "heure_Prevu_Sortie" =>$request->heureSortiePrevue,
    ]);
    if(isset($request->lit) && ($request->lit !=0))
    {   
      BedReservation::firstOrCreate([
          "id_rdvHosp"=>$rdv->id,
          "id_lit" =>$request->lit,
      ]);           
    }
    DemandeHospitalisation::whereId($request->demande_id)->update(['etat' =>1]);
    return redirect()->action('RdvHospiController@getlisteRDVs');
  }
  public function getlisteRDVs()
  {
    $specialite = Auth::user()->employ->Service->Specialite;
    //j'affiche pas les lits affecté// ->doesntHave('demandeHospitalisation.bedAffectation')
    $rdvHospis = rdv_hospitalisation::with('bedReservation')
                                      ->whereHas('demandeHospitalisation',function ($q){
                                           $q->where('service',Auth::user()->employ->service_id)->where('etat',1);      
                                    })->whereNull('etat')->get();                                         
    return view('rdvHospi.liste',compact('specialite','rdvHospis'));
  }
  public function edit(Request $request, $id)
  {
    if($request->ajax())
      return  rdv_hospitalisation::with('demandeHospitalisation.consultation.patient','demandeHospitalisation.Service')->find($id);
    else
    {
      $specialite = Auth::user()->employ->Service->Specialite;
      $services = service::where('type','<>',2)->where('hebergement','1')->get();
      $rdv =  rdv_hospitalisation::with('demandeHospitalisation.consultation.patient','demandeHospitalisation.DemeandeColloque','bedReservation')->FindOrFail($id);
      return view('rdvHospi.edit', compact('specialite','services','rdv'));       
    }  
  }
  public function update(Request $request,$id)
  {
        $rdvHospi = rdv_hospitalisation::find($id);
        if(isset($request->lit_id) && ($request->lit_id !=0)) // reserver le nouveau lit
        {  
              if(isset($rdvHospi->bedReservation))//$rdvHospi->has('bedReservation')
                    $rdvHospi->bedReservation()->update([ "id_lit" =>$request->lit_id  ]);
               else
              {
                      $rdvHospi->bedReservation()->firstOrCreate([  "id_lit" =>$request->lit_id   ]);
              }
        }else
      {
              if(isset($rdvHospi->bedReservation))
                       $rdvHospi->bedReservation()->delete();
        }
      $rdvHospi->update([//update un nouveu Rendez-Vous
              "date"=>$request->dateEntree,
              "heure"=>$request->heure,   
                "id_demande"=>$rdvHospi->demandeHospitalisation->id,
                 "date_Prevu_Sortie"=>$request->dateSortiePre,
               "heure_Prevu_Sortie" =>$request->heureSortiePrevue,
        ]);
        return redirect()->action('RdvHospiController@getlisteRDVs');
  }
  public function destroy(rdv_hospitalisation $rdvHospi)
  { 
    $specialite = Auth::user()->employ->Service->Specialite;  
    if(isset($rdvHospi->bedReservation))  
      $rdvHospi->bedReservation()->delete(); 
    $state = ($specialite->dhValid) ? 5: null;
    $rdvHospi->demandeHospitalisation->update(["etat"=>$state]);
    $rdvHospi->update(["etat"=>0]);
    return redirect()->action('RdvHospiController@getlisteRDVs');
  }
  public function print($id)
  { 
    $today =  Carbon::today()->format('d/m/Y');
    $rdv = rdv_hospitalisation::with('demandeHospitalisation')->FindOrFail($id);
    $patient =  $rdv->demandeHospitalisation->consultation->patient;
    $etab = Etablissement::first();
    $pdf = PDF::loadView('rdvHospi.rdvPDF', compact('rdv','today','etab'))->setPaper('a4','landscape');
    $name = "rdv-".$patient->Nom."-".$patient->Prenom.".pdf";
    return $pdf->stream($name);
  }
  public function ticketPrint($id)//imprimer rdv d'hospitalisation 
  {
    $rdv = rdv_hospitalisation::with('demandeHospitalisation')->FindOrFail($id);
  }
   
}
