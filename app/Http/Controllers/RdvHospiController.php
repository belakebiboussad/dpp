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
  public function index()
  {
    $now = date("Y-m-d", strtotime('now'));    
    $services = service::where('type','<>',2)->where('hebergement','1')->get();
/*$demandes = dem_colloque::whereHas('demandeHosp.Service', function ($q) {$q->where('id', Auth::user()->employ->service_id);})->whereHas('demandeHosp',function ($q){$q->where('etat',5); })->get();*/  
    $demandes =DemandeHospitalisation::with('DemeandeColloque')->where('etat',5) ->where('service',Auth::user()->employ->service_id)->get();
    $demandesUrg= DemandeHospitalisation::doesntHave('bedAffectation')
                                        ->whereHas('consultation',function($q) use($now){
                                             $q->where('date', $now);
                                        })->where('modeAdmission','2')->where('etat',null)->where('service',Auth::user()->employ->service_id)->get(); //'en attente'
     return view('rdvHospi.index', compact('demandes','demandesUrg','services'));
  }
  public function create($id)
  {
    $demande = dem_colloque::where('dem_colloques.id_demande','=',$id)->first();
    $services = service::where('type','<>',2)->where('hebergement','1')->get();
    return view('rdvHospi.add', compact('demande','services'));
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
        $demande= DemandeHospitalisation::find($request->demande_id);
        $demande->update(['etat' =>1]); 
        return redirect()->action('RdvHospiController@index');
  }
  public function getlisteRDVs()
  {
    $rdvHospis = rdv_hospitalisation::with('bedReservation')->whereHas('demandeHospitalisation', function($q){
                                                       $q->where('etat', 1);
                                             })->whereHas('demandeHospitalisation.Service',function($q){
                                                  $q->where('id',Auth::user()->employ->service_id);       
                                             })->where('etat', null)->get();
    return view('rdvHospi.liste',compact('rdvHospis'));
  }
  public function edit($id)
  {
    $rdv =  rdv_hospitalisation::with('bedReservation')->find($id);
    $demande  = dem_colloque::where('dem_colloques.id_demande','=',$rdv->demandeHospitalisation->id)->first();
    $services = service::where('type','<>',2)->where('hebergement','1')->get();
    return view('rdvHospi.edit', compact('demande','services','rdv'));   // return view('rdvHospi.edit', compact('demande','services','rdv'));         
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
  public function destroy($id)
  {   
        $rdvHospi =  rdv_hospitalisation::find($id);  
        if(isset($rdvHospi->bedReservation))  
              $rdvHospi->bedReservation()->delete();
          $rdvHospi->demandeHospitalisation->etat =5;//"valide";
          $rdvHospi->demandeHospitalisation->save();
          $rdvHospi->etat=0;
          $rdvHospi->save(); 
          return redirect()->action('RdvHospiController@getlisteRDVs');
  }
  public function getRdvs(Request $request)
  {
        $today = Carbon::now()->format('Y-m-d');
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
                                               $q->where('etat', 1);//'0'
                                      })->whereHas('demandeHospitalisation.consultation.patient',function($q)use($ipp){
                                               $q->where('IPP', $ipp);
                                      })->where('date',$today)->get();
            break;  
          default:
            break;       
         }  
         return Response::json($rdvs);
  }  
  public function print($id)
  { 
        $t = Carbon::now();
        $rdv = rdv_hospitalisation::with('demandeHospitalisation')->FindOrFail($id);
        $patient =  $rdv->demandeHospitalisation->consultation->patient;
        $etab = Etablissement::first();
        $pdf = PDF::loadView('rdvHospi.rdv', compact('rdv','t','etab'))->setPaper('a4','landscape');
        $name = "rdv-".$patient->Nom."-".$patient->Prenom.".pdf";
        return $pdf->stream($name);
  }
  public function ticketPrint($id)//imprimer rdv d'hospitalisation 
  {
    $rdv = rdv_hospitalisation::with('demandeHospitalisation')->FindOrFail($id);
  }
   
}
