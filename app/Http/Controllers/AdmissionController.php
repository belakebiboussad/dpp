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
/* $admissions = admission::join('rdv_hospitalisations','admissions.id','=','rdv_hospitalisations.id_admission') ->join('demandehospitalisations','admissions.id_demande','=','demandehospitalisations.id') ->select('admissions.id as id_admission','admissions.*','rdv_hospitalisations.*') ->where('etat_RDVh','<>','validé')->where('date_RDVh','=',date("Y-m-d"))->get();  */         
                $rdvs = rdv_hospitalisation::with('bedReservation')->whereHas('demandeHospitalisation', function($q){
                                               $q->where('etat', 'programme');
                                               })->where('etat_RDVh','=','en attente')->where('date_RDVh','=',date("Y-m-d"))->get(); 
               return view('home.home_agent_admis', compact('rdvs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
      /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
      public function store(Request $request)
      {
              $rdvHospi =  rdv_hospitalisation::find($request->id_RDV);
               $adm=admission::create([     
                    "id_rdvHosp"=>$request->id_RDV,       
                    "id_lit"=>$rdvHospi->bedReservation->id_lit,
              ]);
              
               $adm->rdvHosp->demandeHospitalisation->update([
                    "etat" => "admise",
               ]);
               return redirect()->action('AdmissionController@index');
      }  
      public function storeold(Request $request)
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
                "date_Prevu_Sortie"=>$request->dateSortiePre,
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
            return view('admission.index', compact('demandes'));    
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
      public function destroy($id) {
        
      } 
      public function getAdmissions($date)
      {
        /*
        $rdvs = admission::join('rdv_hospitalisations','admissions.id','=','rdv_hospitalisations.id_admission')
                              ->join('demandehospitalisations','admissions.id_demande','=','demandehospitalisations.id')
                              ->join('consultations','demandehospitalisations.id_consultation','=','consultations.id')  
                              ->join('patients','consultations.Patient_ID_Patient','=','patients.id')
                              ->join('lits','lits.id','=','admissions.id_lit')
                              ->join('salles','salles.id','=','lits.salle_id')
                              ->join('services','services.id','=','salles.service_id')
                              ->select('admissions.id as id_admission','admissions.*','demandehospitalisations.etat','rdv_hospitalisations.*','rdv_hospitalisations.id as idRDV',
                                  'patients.Nom','patients.Prenom','services.nom as nom_service','salles.nom as nom_salle','lits.num as num_lit')
                              ->where('etat_RDVh','=','en attente')->where('date_RDVh','=', $date)->get();            
        */  
      }  
}
