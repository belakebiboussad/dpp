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
use Auth;
use Carbon\Carbon;
use PDF;
class RdvHospiController extends Controller
{
  public function index()
  {
      $services = service::all();
     $demandes = dem_colloque::whereHas('demandeHosp.Service', function ($q) {
                                       $q->where('id', Auth::user()->employ->service);                           
                                })->whereHas('demandeHosp',function ($q){
                                $q->where('etat','valide'); 
                            })->get();
      $demandesUrg= DemandeHospitalisation::doesntHave('bedAffectation')->whereHas('Service',function($q) {
          $q->where('id',Auth::user()->employ->service);
      })->where('modeAdmission','urgence')->where('etat','en attente')->get();
      return view('rdvHospi.index', compact('demandes','demandesUrg','services'));
  }
  public function create($id)
  {
    $demande = dem_colloque::where('dem_colloques.id_demande','=',$id)->first(); // dd($demande->demandeHosp->RDVs->where('etat_RDVh', 0));//
      $services = service::all();
    return view('rdvHospi.create', compact('demande','services'));
  }
  public function store(Request $request)
  {
    $ServiceID = Auth::user()->employ->service;
    $rdv = rdv_hospitalisation::firstOrCreate([
            "date_RDVh"         =>$request->dateEntree,
            "heure_RDVh"        =>$request->heure_rdvh,   
            "id_demande"        =>$request->id_demande,       
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
    $demande= DemandeHospitalisation::find($request->id_demande);
    $demande->update([
        'etat' => 'programme'
    ]); 
    return redirect()->action('RdvHospiController@index');
  }
  public function getlisteRDVs()
  {
    $rdvHospis = rdv_hospitalisation::whereHas('demandeHospitalisation', function($q){
                                                       $q->where('etat', 'programme');
                                             })
                                             ->whereHas('demandeHospitalisation.Service',function($q){
                                                  $q->where('id',Auth::user()->employ->service);       
                                             })->where('etat_RDVh','=',null)->get();

    return view('rdvHospi.liste',compact('rdvHospis'));
  }
  public function edit($id)
  {
      $rdv =  rdv_hospitalisation::with('bedReservation')->find($id);/*if(isset($rdv->bedReservation))  $rdv->bedReservation()->delete();  */
      /*
      $salle =salle::findOrFail(4);
      // dd(strtotime($rdv->date_RDVh));
      foreach ($salle->lits as $lit) {
             //$free = true;
           if($lit->id ==7)
            {
                 
                    $id =$lit->id;
                    $reservations =  bedReservation::whereHas('lit',function($q) use($id){ //toute les reservation du lit
                                                                          $q->where('id',$id);
                                                                      })->get();
                    foreach ($reservations as $key => $reservation) {
                           if(( strtotime($rdv->date_RDVh) < strtotime($reservation->rdvHosp->date_Prevu_Sortie)) && (strtotime($rdv->date_Prevu_Sortie) > strtotime($reservation->rdvHosp->date_RDVh)))
                                 $free = false;
                    }
                  
                    $free = $lit->isFree($lit->id,strtotime($rdv->date_RDVh),strtotime($rdv->date_Prevu_Sortie)); 
                     dd( $free);
           }
       }  
 */
       $demande  = dem_colloque::where('dem_colloques.id_demande','=',$rdv->demandeHospitalisation->id)->first();
      $services = service::all();
       return view('rdvHospi.edit', compact('demande','services','rdv'));   // return view('rdvHospi.edit', compact('demande','services','rdv'));         
  }
  public function update(Request $request,$id)
  {
    $rdvHospi = rdv_hospitalisation::find($id);

    if(isset($request->lit_id) && ($request->lit_id !=0)) // reserver le nouveau lit
    {  
      if(isset($rdvHospi->bedReservation))//$rdvHospi->has('bedReservation')
        $rdvHospi->bedReservation()->update([
          "id_lit" =>$request->lit_id 
        ]);
      else
      {
        $rdvHospi->bedReservation()->firstOrCreate([
          "id_lit" =>$request->lit_id,
        ]);
      }
    }else
    {
      if(isset($rdvHospi->bedReservation))
        $rdvHospi->bedReservation()->delete();
    }
    $rdvHospi->update([//update un nouveu Rendez-Vous
          "date_RDVh"=>$request->dateEntree,
          "heure_RDVh"=>$request->heure_rdvh,   
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
        $rdvHospi->demandeHospitalisation->etat ="valide";
        $rdvHospi->demandeHospitalisation->save();
        $rdvHospi->etat_RDVh=0;
        $rdvHospi->save(); 
        return redirect()->action('RdvHospiController@getlisteRDVs');
  }
  public function getRdvs($date)
  {
    $rdvs = rdv_hospitalisation::with('bedReservation.lit.salle.service','demandeHospitalisation.consultation.patient','demandeHospitalisation.Service')
                                ->where('etat_RDVh','=',null)
                                ->whereHas('demandeHospitalisation', function($q){
                                    $q->where('etat', 'programme');
                                })->where('date_RDVh','=', $date)->get(); 
    if (!empty($rdvs)) {
      return json_encode($rdvs);
    }
  }  
  public function print($id)//imprimer rdv d'hospitalisation 
  { 
    $t = Carbon::now();
    $rdv = rdv_hospitalisation::with('demandeHospitalisation')->FindOrFail($id);
    $patient =  $rdv->demandeHospitalisation->consultation->patient;
    $pdf = PDF::loadView('rdvHospi.rdv', compact('rdv','t'))->setPaper('a4','landscape');
    $name = "rdv-".$patient->Nom."-".$patient->Prenom.".pdf";
    return $pdf->stream($name);
  } 
}
