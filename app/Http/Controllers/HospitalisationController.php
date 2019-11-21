<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\modeles\DemandeHospitalisation;
use App\modeles\hospitalisation;
use App\modeles\consultation;
use App\modeles\dem_colloque;
use App\modeles\employ;
use App\modeles\rdv_hospitalisation;
use Illuminate\Support\Facades\Auth;
use App\modeles\admission;
class HospitalisationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $hospitalisations = consultation::join('demandehospitalisations','consultations.id','=','demandehospitalisations.id_consultation')
        //                                 ->join('hospitalisations','hospitalisations.id_demande','=','demandehospitalisations.id')
        //                                 ->select('demandehospitalisations.*','hospitalisations.*','consultations.Employe_ID_Employe',
        //                                          'Patient_ID_Patient')->get();
        // return view('Hospitalisations.index_hospitalisation', compact('hospitalisations'));  

        //
        //bouzidi en dessous
         $hospitalisations = consultation::join('demandehospitalisations','consultations.id','=','demandehospitalisations.id_consultation')
                        ->join('admissions','admissions.id_demande','=','demandehospitalisations.id')
                        ->join('patients','consultations.Patient_ID_Patient','=','patients.id')
                         ->join('hospitalisations','hospitalisations.id_admission','=','admissions.id')
                        ->join('lits','lits.id','=','admissions.id_lit')
                        ->join('salles','salles.id','=','lits.salle_id')
                        ->join('services','services.id','salles.id')
                        ->select('hospitalisations.id as id_hospitalisation','admissions.id_lit','lits.num as num_lit','salles.nom as nom_salle','services.nom as nom_service','hospitalisations.*','patients.Nom','patients.Prenom')
                            ->where("hospitalisations.etat_hosp","<>","validée")->get();
                            //dd($hospitalisations);
        $e=false;
        return view('Hospitalisations.index_hospitalisation', compact('hospitalisations','e'));  
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $demande = DemandeHospitalisation::FindOrFail($id);
        return view('Hospitalisations.create_hospitalisation', compact('demande'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {       
        $rdvHospi =  rdv_hospitalisation::find($request->id_RDV);
        $rdvHospi->etat_RDVh="valide";      
        $rdvHospi->save();
        $demande= demandehospitalisation::find(admission::find($request->id_ad)->id_demande);
        $demande->etat = "admise";
        $demande->save(); 
        $a = hospitalisation::create([
            "Date_entree"=>$rdvHospi->date_RDVh,
            "Date_Prevu_Sortie"=>$rdvHospi->date_Prevu_Sortie,
            "Date_Sortie"=>null,
                "id_demande"=>$demande->id,
        ]);
        return \Redirect::route('HomeController@index');
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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatep(Request $request, $id)
    {
        //
       dd("update");
    }
     public function update(Request $request)
    {
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
    public function getlisteRDVs()
    {
        $employe = employ::where("id",Auth::user()->employee_id)->get()->first();
        $ServiceID = $employe->Service_Employe; 
        $rdvHospitalisation = rdv_hospitalisation::whereHas('admission.demandeHospitalisation', function($q){
                                                           $q->where('etat', 'programme');
                                                 })
                                                 ->whereHas('admission.demandeHospitalisation.Service',function($q) use ($ServiceID){
                                                      $q->where('id',$ServiceID);       
                                                 })->where('etat_RDVh','=','en attente')->get();  

        return view('Hospitalisations.listRDVs_hospitalisation', compact('rdvHospitalisation'));
    }
    public function ajouterRDV()
    {
        $employe = employ::where("id",Auth::user()->employee_id)->get()->first();  
        $ServiceID = $employe->Service_Employe;
        $demandes = dem_colloque::whereHas('demandeHosp.Service', function ($q) use ($ServiceID) {
                                           $q->where('id',$ServiceID);                           
                                    })
                                ->whereHas('demandeHosp',function ($q){
                                    $q->where('etat','valide'); 
                                })->get();
        return view('home.home_surv_med', compact('demandes'));

    }
}
