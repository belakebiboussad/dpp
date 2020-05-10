<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\modeles\dem_colloque;
use App\modeles\service;
use App\modeles\rdv_hospitalisation;
use App\modeles\BedReservation;
use App\modeles\employ;
use App\modeles\DemandeHospitalisation;
use App\modeles\Lit;
use Auth;
class RdvHospiController extends Controller
{
      public function create($id)
      {
       	$demande = dem_colloque::where('dem_colloques.id_demande','=',$id)->first();
             $services = service::all();
              return view('rdvHospi.create', compact('demande','services'));
    	}
	public function store(Request $request)
      {
       	$employe = employ::where("id",Auth::user()->employee_id)->get()->first();
             $ServiceID = $employe->Service_Employe;
             $rdv = rdv_hospitalisation::firstOrCreate([
                    "date_RDVh"         =>$request->dateEntree,
                    "heure_RDVh"        =>$request->heure_rdvh,   
                    "id_demande"        =>$request->id_demande,       
                    "etat_RDVh"         =>"en attente",
                    "date_Prevu_Sortie" =>$request->dateSortiePre,
                    "heure_Prevu_Sortie" =>$request->heureSortiePrevue,
             ]);
             if(isset($request->lit) && ($request->lit !=0))
              {   
                   // $lit = Lit::find($request->lit);
                   //  $lit->affectation = 1;
                   //  $lit->save();  
                   BedReservation::firstOrCreate([
            	  		"id_rdvHosp"=>$rdv->id,
            	  		"id_lit" =>$request->lit,
           	  	]);           
             }
             $demande= DemandeHospitalisation::find($request->id_demande);
             $demande->etat = 'programme';
             $demande->save();
            $demandes = dem_colloque::whereHas('demandeHosp.Service', function ($q) use ($ServiceID) {
                                       $q->where('id',$ServiceID);                           
                                 })->whereHas('demandeHosp',function ($q){
                                       $q->where('etat','valide'); //valier par le colloque
                                 })->get(); 
             return view('rdvHospi.index', compact('demandes'));
       }
       public function getlisteRDVs()
      {
            $employe = employ::where("id",Auth::user()->employee_id)->get()->first();
            $ServiceID = $employe->Service_Employe;
            $rdvHospis = rdv_hospitalisation::whereHas('demandeHospitalisation', function($q){
                                                               $q->where('etat', 'programme');
                                                     })
                                                     ->whereHas('demandeHospitalisation.Service',function($q) use ($ServiceID){
                                                          $q->where('id',$ServiceID);       
                                                     })->where('etat_RDVh','=','en attente')->get();       
            return view('rdvHospi.listRDVs_hospitalisation', compact('rdvHospis'));
      }
     public function edit($id)
     {
             $rdv =  rdv_hospitalisation::with('bedReservation')->find($id);
             /* if ( isset $rdv->bedReservation) ){$rdv->bedReservation->lit->affectation=0;$rdv->bedReservation->lit->save();}*/
             $demande  = dem_colloque::where('dem_colloques.id_demande','=',$rdv->demandeHospitalisation->id)->first();
            $services = service::all();
             return view('admission.edit_admission', compact('demande','services','rdv'));   // return view('rdvHospi.edit', compact('demande','services','rdv'));         
      }
      public function update(Request $request,$id)
      {
            $rdvHospi =  rdv_hospitalisation::find($id);
             //liberer le lit affecter
             if(isset($rdvHospi->bedReservation->id_lit))
                   $rdvHospi->bedReservation()->delete(); //$rdvHospi->bedReservation->lit->affectation=0;    $rdvHospi->bedReservation->lit->save();
            // reserver le nouveau lit
             if(isset($request->lit) && ($request->lit !=0))
            {   // $lit = Lit::find($request->lit); // $lit->affectation = 1; // $lit->save();  
                   BedReservation::firstOrCreate([
                        "id_rdvHosp"=>$rdvHospi->id,
                        "id_lit" =>$request->lit,
                  ]);           
             }
           //update un nouveu Rendez-Vous
            $rdvHospi->update([
                "date_RDVh"=>$request->dateEntree,
                "heure_RDVh"=>$request->heure_rdvh,   
                "id_demande"=>$rdvHospi->demandeHospitalisation->id,       
                "etat_RDVh"=>"en attente",
                "date_Prevu_Sortie"=>$request->dateSortiePre,
                "heure_Prevu_Sortie" =>$request->heureSortiePrevue,
          ]);
          return redirect()->action('RdvHospiController@getlisteRDVs');
      }
    public function sow($id)
    {
        dd("gdfg");
    }
}
