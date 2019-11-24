<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\modeles\colloque;
use App\modeles\DemandeHospitalisation;
use App\modeles\Lit;
use App\modeles\admission;
use App\modeles\rdv_hospitalisation;
use App\modeles\service;
use App\modeles\employ;
use App\User;
use App\modeles\dem_colloque;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AdmissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @return \App\modeles\colloque
     * @return \App\modeles\DemandeHospitalisation
     * @return \App\modeles\Lit
     * @return \App\modeles\admission
     * @return \App\modeles\rdv_hospitalisation
     */
    public function index()
    {
        $admissions = admission::join('rdv_hospitalisations','admissions.id','=','rdv_hospitalisations.id_admission')
                               ->join('demandehospitalisations','admissions.id_demande','=','demandehospitalisations.id')
                               ->select('admissions.id as id_admission','admissions.*','rdv_hospitalisations.*')
                               ->where('etat_RDVh','<>','validé')->where('date_RDVh','=',date("Y-m-d"))->get();                          
        return view('home.home_agent_admis', compact('admissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {  
      
      $demande = dem_colloque::where('dem_colloques.id_demande','=',$id)->get();
      $services = service::all();
      return view('admission.create_admission', compact('demande','services'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        $employe = employ::where("id",Auth::user()->employee_id)->get()->first();
        $ServiceID = $employe->Service_Employe;
        $adm=admission::create([     
            "id_demande"=>$request->id_demande,       
            "id_lit"=>$request->lit,
      
        ]);
        $rdv = rdv_hospitalisation::firstOrCreate([
            "date_RDVh"=>$request->dateEntree,
            "heure_RDVh"=>$request->heure_rdvh,   
            "id_admission"=>$adm->id,       
            "etat_RDVh"=>"en attente",
            "date_Prevu_Sortie"=>$request->dateSortie,
            "heure_Prevu_Sortie" =>$request->heureSortiePrevue,
        ]);    
        $demande= DemandeHospitalisation::find($request->id_demande);
        $demande->etat = 'programme';
        $demande->save();
        if(isset($request->lit))
        { 
          $lit = Lit::FindOrFail($request->lit);          
          $lit-> update([
                "affectation"=>1,
          ]);         
        }
        $demandes = dem_colloque::whereHas('demandeHosp.Service', function ($q) use ($ServiceID) {
                                           $q->where('id',$ServiceID);                           
                                    })
                                ->whereHas('demandeHosp',function ($q){
                                    $q->where('etat','valide'); 
                                })->get();                       
        return view('home.home_surv_med', compact('demandes'));    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
      $rdv =  rdv_hospitalisation::find($id);
      $demande  = dem_colloque::where('dem_colloques.id_demande','=',$rdv->admission->demandeHospitalisation->id)->first();
      $services = service::all();
      return view('admission.edit_admission', compact('demande','services','rdv'));           
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      dd("update");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
  
    public function annulerRDV($id)
    {
     
      $rdvHospi =  rdv_hospitalisation::find($id); 
     
      if(isset($rdvHospi->admission->id_lit))
      {
        $rdvHospi->admission->lit->affectation=0;
        $rdvHospi->admission->lit->save();  
      }
      $rdvHospi->etat_RDVh="Annule";
      $rdvHospi->save();
      $rdvHospi->admission->demandeHospitalisation->setEtatAttribute("valide");
      $rdvHospi->admission->demandeHospitalisation->save();  
      $rdvHospi->admission->delete();
      return true; 
    } 
    public function reporterRDV (Request $request,$rdv_id)
    {
      $rdvHospi =  rdv_hospitalisation::find($rdv_id);
      //liberer le lit affecter
      if(isset($rdvHospi->admission->id_lit))
      {
      
        $rdvHospi->admission->lit->affectation=0;
        $rdvHospi->admission->lit->save();  
      } 
    
      // reserver le nouveau lit
      if(isset($request->lit))  
      {
          $lit = Lit::find($request->lit);
          $lit->affectation = 1;
          $lit->save();
      }
      
      //annuler Rendez-Vous
      $rdvHospi->etat_RDVh="Annule";
      $rdvHospi->save();
      //créer une nouvelle admission
      $adm=admission::create([     
              "id_demande"=>$rdvHospi->admission->id_demande,       
              "id_lit"=>$request->lit,
      ]);
      //supprimer l'admission de l'ancien RDVH      
      $rdvHospi->admission->delete();
      //crée un nouveu Rendez-Vous
      $rdv = rdv_hospitalisation::firstOrCreate([
            "date_RDVh"=>$request->dateEntree,
            "heure_RDVh"=>$request->heure_rdvh,   
            "id_admission"=>$adm->id,       
            "etat_RDVh"=>"en attente",
            "date_Prevu_Sortie"=>$request->dateSortie,
            "heure_Prevu_Sortie" =>$request->heureSortiePrevue,
      ]);
      return redirect()->action('HospitalisationController@getlisteRDVs');

    }
    public function affecterLit()
    {
      $employe = employ::where("id",Auth::user()->employee_id)->get()->first();
      $ServiceID = $employe->Service_Employe; 
      $rdvHospitalisation = rdv_hospitalisation::whereHas('admission.demandeHospitalisation', function($q){
                                                           $q->where('etat', 'programme');
                                                 })
                                                 // ->whereHas('admission',function($q){
                                                 //      $q->where('id_lit',null);       
                                                 // }) 
                                                 ->whereHas('admission.demandeHospitalisation.Service',function($q) use ($ServiceID){
                                                      $q->where('id',$ServiceID);       
                                                 })->where('etat_RDVh','=','en attente')->get();  

      return view('admission.affecterLits', compact('rdvHospitalisation'));
    }

}
